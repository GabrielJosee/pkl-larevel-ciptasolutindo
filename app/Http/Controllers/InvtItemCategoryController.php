<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PublicController;
use App\Providers\RouteServiceProvider;
use App\Models\InvtItemCategory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InvtItemCategoryController extends PublicController
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
        Session::forget('sess_servicetoken');
        Session::forget('data_invtitemcategory');
        $invtitemcategory = InvtItemCategory::where('data_state','=',0)->get();

        return view('content/InvtItemCategory/ListInvtItemCategory',compact('invtitemcategory'));
    }

    public function addInvtItemCategory(Request $request)
    {
        $item_category_token		= Session::get('sess_servicetoken');

        if (empty($item_category_token)){
            $item_category_token = md5(date("YmdHis"));
            Session::put('sess_servicetoken', $item_category_token);
        }

        $item_category_token		= Session::get('sess_servicetoken');
        $InvtItemCategory           = Session::get('data_invtitemcategory');

        return view('content/InvtItemCategory/FormAddInvtItemCategory', compact('item_category_token', 'InvtItemCategory'));
    }

    public function addElementsInvtItemCategory(Request $request)
    {
        $data_invtitemcategory[$request->name] = $request->value;

        Session::put('data_invtitemcategory', $data_invtitemcategory);
        
        return redirect('/item-category/add');
    }

    public function addReset()
    {
        Session::forget('sess_servicetoken');
        Session::forget('data_invtitemcategory');

        return redirect('/item-category/add');
    }

    public function processAddInvtItemCategory(Request $request)
    {
        $fields = $request->validate([
            'item_category_name' => 'required',
        ]);
        
        $data = array(
            'item_category_name'              => $fields['item_category_name'], 
            'item_category_token'             => $request->item_category_token, 
            'created_id'                => Auth::id(),
            'data_state'                => 0
        );

        $item_category_token 				    = InvtItemCategory::select('item_category_token')
            ->where('item_category_token', '=', $data['item_category_token'])
            ->get();

        if(count($item_category_token) == 0){
            if(InvtItemCategory::create($data)){
                $this->set_log(Auth::id(), Auth::user()->name, '1089', 'Application.InvtItemCategory.processAddInvtItemCategory', Auth::user()->name, 'Add Invt Service');

                $msg = 'Tambah Data Bidang Berhasil';

                Session::forget('sess_servicetoken');
                Session::forget('data_invtitemcategory');
                return redirect('/item-category/add')->with('msg',$msg);
            } else {
                $msg = 'Tambah Data Bidang Gagal';
                return redirect('/item-category/add')->with('msg',$msg);
            }
        } else {
            $msg = 'Tambah Data Bidang Gagal - Data Bidang Sudah Ada';
            return redirect('/item-category/add')->with('msg',$msg);
        }
        
    }

    public function editInvtItemCategory($item_category_id)
    {
        $invtitemcategory = InvtItemCategory::where('item_category_id',$item_category_id)->first();

        return view('content/InvtItemCategory/FormEditInvtItemCategory',compact('invtitemcategory'));
    }

    public function processEditInvtItemCategory(Request $request)
    {
        $fields = $request->validate([
            'item_category_id'   => 'required',
            'item_category_name' => 'required',
        ]);

        $item                   = InvtItemCategory::findOrFail($fields['item_category_id']);
        $item->item_category_name     = $fields['item_category_name'];
        $item->updated_id       = Auth::id();


        if($item->save()){
            $msg = 'Edit Bidang Berhasil';
            return redirect('/item-category')->with('msg',$msg);
        }else{
            $msg = 'Edit Bidang Gagal';
            return redirect('/item-category')->with('msg',$msg);
        }
    }

    public function deleteInvtItemCategory($item_category_id)
    {
        $item               = InvtItemCategory::findOrFail($item_category_id);
        $item->data_state   = 1;
        $item->deleted_id   = Auth::id();
        $item->deleted_at   = date("Y-m-d H:i:s");
        if($item->save())
        {
            $msg = 'Hapus Bidang Berhasil';
        }else{
            $msg = 'Hapus Bidang Gagal';
        }

        return redirect('/item-category')->with('msg',$msg);
    }
}
