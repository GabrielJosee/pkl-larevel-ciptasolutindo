<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PublicController;
use App\Models\InvtItemVariant;
use App\Models\Sales;
use App\Models\SalesItem;
use App\Models\InvtItemReview;
use App\Models\CorePayment;
use App\Models\SystemUserSeller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Configuration;

class InvtItemReviewController extends PublicController
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
        $itemreview = InvtItemReview::select('invt_item_review.*', 'sales.sales_no', 'system_user_buyer.buyer_name', 'invt_item.item_name')
        ->join('sales', 'sales.sales_id', 'invt_item_review.sales_id')
        ->join('system_user_buyer', 'sales.buyer_id', 'system_user_buyer.buyer_id')
        ->join('invt_item', 'invt_item.item_id', 'invt_item_review.item_id')
        ->where('invt_item_review.data_state', 0)
        ->get();
        
        if(!Session::get('start_date')){
            $start_date     = date('Y-m-d');
        }else{
            $start_date     = Session::get('start_date');
        }

        if(!Session::get('end_date')){
            $end_date       = date('Y-m-d');
            $stop_date      = date('Y-m-d', strtotime($end_date . ' +1 day'));
        }else{
            $end_date       = Session::get('end_date');
            $stop_date      = date('Y-m-d', strtotime($end_date . ' +1 day'));
        }

        return view('content/InvtItemReview/ListInvtItemReview',compact('itemreview', 'start_date', 'end_date'));
    }

    public function filter(Request $request){
        $start_date    = $request->start_date;
        $end_date      = $request->end_date;

        Session::put('start_date', $start_date);
        Session::put('end_date', $end_date);

        return redirect('/item-review');
    }

    public function attachmentInvtItemReview($sales_payment_id)
    {
        $salespayment   = InvtItemReview::select('sales_payment.*', 'core_payment.payment_name', 'system_user_seller.seller_name', 'system_user_buyer.buyer_name', 'sales.sales_no')
        ->join('sales', 'sales.sales_id', 'sales_payment.sales_id')
        ->join('core_payment', 'core_payment.payment_id', 'sales.payment_id')
        ->join('system_user_seller', 'system_user_seller.seller_id', 'sales.seller_id')
        ->join('system_user_buyer', 'system_user_buyer.buyer_id', 'sales.buyer_id')
        ->where('sales_payment.sales_payment_id',$sales_payment_id)
        ->first();

        return view('content/InvtItemReview/FormDetailInvtItemReview',compact('salespayment'));
    }

    public function getItemVariantName($item_variant_id){
        $itemvariant = InvtItemVariant::select('item_variant_name')
        ->where('item_variant_id', $item_variant_id)
        ->first();

        return $itemvariant['item_variant_name'];
    }

    public function deleteInvtItemReview($item_id)
    {
        $item               = InvtItemReview::findOrFail($item_id);
        $item->data_state   = 1;
        $item->deleted_id   = Auth::id();
        $item->deleted_at   = date("Y-m-d H:i:s");
        
        if($item->save())
        {
            $msg = 'Hapus Review Berhasil';
        }else{
            $msg = 'Hapus Review Gagal';
        }

        return redirect('/item-review')->with('msg',$msg);
    }
}
