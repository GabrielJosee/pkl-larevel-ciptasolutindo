<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PublicController;
use App\Providers\RouteServiceProvider;
use App\Models\CoreBanner;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CoreBannerController extends PublicController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Session::forget('sess_corebannertoken');
        Session::forget('data_corebanner');
        $corebanner = CoreBanner::where('data_state', 0)->get();

        return view('content/CoreBanner/ListCoreBanner',compact('corebanner'));
    }

    public function addCoreBanner(Request $request)
    {
        $banner_token		= Session::get('sess_corebannertoken');

        if (empty($banner_token)){
            $banner_token = md5(date("YmdHis"));
            Session::put('sess_corebannertoken', $banner_token);
        }

        $banner_token    = Session::get('sess_corebannertoken');
        $CoreBanner             = Session::get('data_corebanner');

        return view('content/CoreBanner/FormAddCoreBanner', compact('banner_token', 'CoreBanner'));
    }

    public function addElementsCoreBanner(Request $request)
    {
        $data_corebanner[$request->name] = $request->value;

        Session::put('data_corebanner', $data_corebanner);
        
        return redirect('/item-category/add');
    }

    public function addReset()
    {
        Session::forget('sess_corebannertoken');
        Session::forget('data_corebanner');

        return redirect('/item-category/add');
    }

    public function processAddCoreBanner(Request $request)
    {
        $fields = $request->validate([
            'banner_name'           => 'required',
            'banner_redirect_link'  => 'required',
            'banner_image'          => 'required',
            'banner_token'          => 'required',
        ]);
        
        
        $fileNameToStore = '';

        if($request->hasFile('banner_image')){
            $filenameWithExt    = $request->file('banner_image')->getClientOriginalName();
            $filename           = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension          = $request->file('banner_image')->getClientOriginalExtension();
            $fileNameToStore    = $filename.'_'.time().'.'.$extension;
            $path               = $request->file('banner_image')->storeAs('public/banner',$fileNameToStore);
        }

        $data = array(
            'banner_name'               => $fields['banner_name'], 
            'banner_redirect_link'      => $fields['banner_redirect_link'], 
            'banner_token'              => $fields['banner_token'], 
            'banner_image'              => $fileNameToStore, 
            'created_id'                => Auth::id(),
            'data_state'                => 0
        );

        $banner_token 				    = CoreBanner::select('banner_token')
            ->where('banner_token', '=', $data['banner_token'])
            ->get();

        if(count($banner_token) == 0){
            if(CoreBanner::create($data)){
                $this->set_log(Auth::id(), Auth::user()->name, '1089', 'Application.CoreBanner.processAddCoreBanner', Auth::user()->name, 'Add Invt Service');

                $msg = 'Tambah Data Banner Berhasil';

                Session::forget('sess_corebannertoken');
                Session::forget('data_corebanner');
                return redirect('/banner/add')->with('msg',$msg);
            } else {
                $msg = 'Tambah Data Banner Gagal';
                return redirect('/banner/add')->with('msg',$msg);
            }
        } else {
            $msg = 'Tambah Data Banner Gagal - Data Banner Sudah Ada';
            return redirect('/banner/add')->with('msg',$msg);
        }
        
    }

    public function editCoreBanner($banner_id)
    {
        $corebanner = CoreBanner::where('banner_id',$banner_id)->first();

        return view('content/CoreBanner/FormEditCoreBanner',compact('corebanner'));
    }

    public function processEditCoreBanner(Request $request)
    {
        $fields = $request->validate([
            'banner_id'             => 'required',
            'banner_name'           => 'required',
            'banner_redirect_link'  => 'required',
        ]);

        $corebanner                 = CoreBanner::findOrFail($fields['banner_id']);

        if($request->hasFile('banner_image')){
            $filenameWithExt            = $request->file('banner_image')->getClientOriginalName();
            $filename                   = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension                  = $request->file('banner_image')->getClientOriginalExtension();
            $fileNameToStore            = $filename.'_'.time().'.'.$extension;
            $path                       = $request->file('banner_image')->storeAs('public/banner',$fileNameToStore);
            Storage::delete('/public/banner/'.$corebanner->banner_image);
            $corebanner->banner_image   = $fileNameToStore;
        }

        $corebanner->banner_name              = $fields['banner_name'];
        $corebanner->banner_redirect_link     = $fields['banner_redirect_link'];
        $corebanner->updated_id               = Auth::id();

        if($corebanner->save()){
            $msg = 'Edit Banner Berhasil';
            return redirect('/banner')->with('msg',$msg);
        }else{
            $msg = 'Edit Banner Gagal';
            return redirect('/banner')->with('msg',$msg);
        }
    }

    public function deleteCoreBanner($banner_id)
    {
        $item               = CoreBanner::findOrFail($banner_id);
        $item->data_state   = 1;
        $item->deleted_id   = Auth::id();
        $item->deleted_at   = date("Y-m-d H:i:s");
        if($item->save())
        {
            $msg = 'Hapus Banner Berhasil';
        }else{
            $msg = 'Hapus Banner Gagal';
        }

        return redirect('/banner')->with('msg',$msg);
    }
}
