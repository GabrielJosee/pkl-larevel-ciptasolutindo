<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PublicController;
use App\Providers\RouteServiceProvider;
use App\Models\InvtItem;
use App\Models\InvtItemCategory;
use App\Models\InvtItemVariant;
use App\Models\User;
use App\Models\SystemUserSeller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InvtItemController extends PublicController
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
        $seller     = SystemUserSeller::select('system_user_seller.seller_id', 'system_user_seller.seller_name')
        ->join('system_user', 'system_user.user_id', 'system_user_seller.user_id')
        ->where('system_user.seller_status', 1)
        ->where('system_user_seller.data_state', 0)
        ->get()
        ->pluck('seller_name','seller_id');

        $invtitemcategory     = InvtItemCategory::select('item_category_id', 'item_category_name')
        ->where('data_state', 0)
        ->get()
        ->pluck('item_category_name','item_category_id');

        $invtitem   = InvtItem::select('invt_item.*', 'system_user_seller.seller_name', 'invt_item_category.item_category_name')
        ->join('system_user_seller', 'system_user_seller.seller_id', 'invt_item.seller_id')
        ->join('invt_item_category', 'invt_item_category.item_category_id', 'invt_item.item_category_id')
        ->where('invt_item.data_state', 0);

        if(!Session::get('seller_id')){
            $seller_id    = null;
        }else{
            $seller_id    = Session::get('seller_id');
            $invtitem     = $invtitem->where('invt_item.seller_id', $seller_id);
        }

        if(!Session::get('item_category_id')){
            $item_category_id    = null;
        }else{
            $item_category_id    = Session::get('item_category_id');
            $invtitem            = $invtitem->where('invt_item.item_category_id', $item_category_id);
        }

        $invtitem   = $invtitem->get();

        return view('content/InvtItem/ListInvtItem',compact('invtitem', 'seller', 'seller_id', 'invtitemcategory', 'item_category_id'));
    }

    public function filter(Request $request){
        $seller_id          = $request->seller_id;
        $item_category_id   = $request->item_category_id;

        Session::put('seller_id', $seller_id);
        Session::put('item_category_id', $item_category_id);

        return redirect('/item');
    }

    public function detailInvtItem($item_id)
    {
        $invtitem           = InvtItem::select('invt_item.*', 'invt_item_category.item_category_name', 'system_user_seller.seller_name')
        ->join('invt_item_category', 'invt_item.item_category_id', 'invt_item_category.item_category_id')
        ->join('system_user_seller', 'invt_item.seller_id', 'system_user_seller.seller_id')
        ->where('invt_item.item_id',$item_id)
        ->first();

        $invtitemvariant    = InvtItemVariant::select('invt_item_variant.*')
        ->where('invt_item_variant.item_id', $item_id)
        ->get();

        return view('content/InvtItem/FormDetailInvtItem',compact('invtitem', 'invtitemvariant'));
    }

    public function blokirInvtItem($item_id)
    {
        $item               = InvtItem::findOrFail($item_id);
        $item->item_status  = 2;
        $item->updated_id   = Auth::id();
        $item->updated_at   = date("Y-m-d H:i:s");
        
        if($item->save())
        {
            $msg = 'Blokir Item Berhasil';
        }else{
            $msg = 'Blokir Item Gagal';
        }

        return redirect('/item')->with('msg',$msg);
    }

    public function blokirInvtItemVariant($item_variant_id)
    {
        $item                       = InvtItemVariant::findOrFail($item_variant_id);
        $item->item_variant_status  = 2;
        $item->updated_id           = Auth::id();
        $item->updated_at           = date("Y-m-d H:i:s");
        
        if($item->save())
        {
            $msg = 'Blokir Variant Item Berhasil';
        }else{
            $msg = 'Blokir Variant Item Gagal';
        }

        return redirect('/item/detail/'.$item['item_id'])->with('msg',$msg);
    }

    public function unblokirInvtItem($item_id)
    {
        $item               = InvtItem::findOrFail($item_id);
        $item->item_status  = 0;
        $item->updated_id   = Auth::id();
        $item->updated_at   = date("Y-m-d H:i:s");
        
        if($item->save())
        {
            $msg = 'Buka Blokir Item Berhasil';
        }else{
            $msg = 'Buka Blokir Item Gagal';
        }

        return redirect('/item')->with('msg',$msg);
    }

    public function unblokirInvtItemVariant($item_variant_id)
    {
        $item                       = InvtItemVariant::findOrFail($item_variant_id);
        $item->item_variant_status  = 0;
        $item->updated_id           = Auth::id();
        $item->updated_at           = date("Y-m-d H:i:s");
        
        if($item->save())
        {
            $msg = 'Buka Blokir Variant Item Berhasil';
        }else{
            $msg = 'Buka Blokir Variant Item Gagal';
        }

        return redirect('/item/detail/'.$item['item_id'])->with('msg',$msg);
    }
}
