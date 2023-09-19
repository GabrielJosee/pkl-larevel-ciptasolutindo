<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PublicController;
use App\Models\InvtItemVariant;
use App\Models\Sales;
use App\Models\SalesItem;
use App\Models\CorePayment;
use App\Models\SystemUserSeller;
use Illuminate\Support\Facades\Session;
use App\Helpers\Configuration;

class SalesController extends PublicController
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

        $sales   = Sales::select('sales.*', 'core_payment.payment_name', 'system_user_seller.seller_name', 'system_user_buyer.buyer_name')
        ->join('core_payment', 'core_payment.payment_id', 'sales.payment_id')
        ->join('system_user_seller', 'system_user_seller.seller_id', 'sales.seller_id')
        ->join('system_user_buyer', 'system_user_buyer.buyer_id', 'sales.buyer_id')
        ->where('sales.data_state', 0);

        $corepayment = CorePayment::select('payment_name', 'payment_id')
        ->where('data_state', 0)
        ->get()
        ->pluck('payment_name', 'payment_id');

        $salesstatus = Configuration::getSalesStatus();

        if(!Session::get('seller_id')){
            $seller_id      = null;
        }else{
            $seller_id      = Session::get('seller_id');
            $sales          = $sales->where('sales.seller_id', $seller_id);
        }

        if(!Session::get('payment_id')){
            $payment_id     = null;
        }else{
            $payment_id     = Session::get('payment_id');
            $sales          = $sales->where('sales.payment_id', $payment_id);
        }

        if(!Session::get('sales_status')){
            $sales_status   = null;
        }else{
            $sales_status   = Session::get('sales_status');
            $sales          = $sales->where('sales.sales_status', $sales_status);
        }
        
        if(!Session::get('start_date')){
            $start_date     = date('Y-m-d');
        }else{
            $start_date = Session::get('start_date');
        }

        if(!Session::get('end_date')){
            $end_date     = date('Y-m-d');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        }else{
            $end_date = Session::get('end_date');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        }

        $sales   = $sales->where('sales.created_at','>=',$start_date)
        ->where('sales.created_at','<=',$stop_date)
        ->get();

        return view('content/Sales/ListSales',compact('sales', 'seller', 'seller_id', 'corepayment', 'payment_id', 'salesstatus', 'sales_status', 'start_date', 'end_date'));
    }

    public function filter(Request $request){
        $start_date    = $request->start_date;
        $end_date      = $request->end_date;
        $seller_id     = $request->seller_id;
        $payment_id    = $request->payment_id;
        $sales_status  = $request->sales_status;

        Session::put('start_date', $start_date);
        Session::put('end_date', $end_date);
        Session::put('seller_id', $seller_id);
        Session::put('payment_id', $payment_id);
        Session::put('sales_status', $sales_status);

        return redirect('/sales');
    }

    public function detailSales($sales_id)
    {
        $sales      = Sales::select('sales.*', 'core_payment.payment_name', 'system_user_seller.seller_name', 'system_user_buyer.buyer_name')
        ->join('core_payment', 'core_payment.payment_id', 'sales.payment_id')
        ->join('system_user_seller', 'system_user_seller.seller_id', 'sales.seller_id')
        ->join('system_user_buyer', 'system_user_buyer.buyer_id', 'sales.buyer_id')
        ->where('sales.sales_id',$sales_id)
        ->first();

        $salesitem  = SalesItem::select('sales_item.*', 'invt_item.item_name')
        ->join('invt_item', 'invt_item.item_id', 'sales_item.item_id')
        ->where('sales_item.sales_id', $sales_id)
        ->get();

        $salesstatus = Configuration::getSalesStatus();

        // print_r($sales);exit;
        
        return view('content/Sales/FormDetailSales',compact('sales', 'salesitem', 'salesstatus'));
    }

    public function getItemVariantName($item_variant_id){
        $itemvariant = InvtItemVariant::select('item_variant_name')
        ->where('item_variant_id', $item_variant_id)
        ->first();

        return $itemvariant['item_variant_name'];
    }
}
