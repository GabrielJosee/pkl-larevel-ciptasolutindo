<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PublicController;
use App\Models\InvtItemVariant;
use App\Models\Sales;
use App\Models\SalesItem;
use App\Models\SalesPayment;
use App\Models\CorePayment;
use App\Models\SystemUserSeller;
use Illuminate\Support\Facades\Session;
use App\Helpers\Configuration;

class SalesPaymentController extends PublicController
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
        $seller         = SystemUserSeller::select('system_user_seller.seller_id', 'system_user_seller.seller_name')
        ->join('system_user', 'system_user.user_id', 'system_user_seller.user_id')
        ->where('system_user.seller_status', 1)
        ->where('system_user_seller.data_state', 0)
        ->get()
        ->pluck('seller_name','seller_id');

        $salespayment   = SalesPayment::select('sales_payment.*', 'core_payment.payment_name', 'system_user_seller.seller_name', 'system_user_buyer.buyer_name', 'sales.sales_no')
        ->join('sales', 'sales.sales_id', 'sales_payment.sales_id')
        ->join('core_payment', 'core_payment.payment_id', 'sales.payment_id')
        ->join('system_user_seller', 'system_user_seller.seller_id', 'sales.seller_id')
        ->join('system_user_buyer', 'system_user_buyer.buyer_id', 'sales.buyer_id')
        ->where('sales_payment.data_state', 0);

        $corepayment    = CorePayment::select('payment_name', 'payment_id')
        ->where('data_state', 0)
        ->get()
        ->pluck('payment_name', 'payment_id');

        $salesstatus    = Configuration::getSalesStatus();

        if(!Session::get('seller_id')){
            $seller_id      = null;
        }else{
            $seller_id      = Session::get('seller_id');
            $salespayment   = $salespayment->where('sales.seller_id', $seller_id);
        }

        if(!Session::get('payment_id')){
            $payment_id     = null;
        }else{
            $payment_id     = Session::get('payment_id');
            $salespayment   = $salespayment->where('sales.payment_id', $payment_id);
        }
        
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

        $salespayment       = $salespayment->where('sales_payment.created_at','>=',$start_date)
        ->where('sales_payment.created_at','<=',$stop_date)
        ->get();

        return view('content/SalesPayment/ListSalesPayment',compact('salespayment', 'seller', 'seller_id', 'corepayment', 'payment_id', 'salesstatus', 'start_date', 'end_date'));
    }

    public function filter(Request $request){
        $start_date    = $request->start_date;
        $end_date      = $request->end_date;
        $seller_id     = $request->seller_id;
        $payment_id    = $request->payment_id;

        Session::put('start_date', $start_date);
        Session::put('end_date', $end_date);
        Session::put('seller_id', $seller_id);
        Session::put('payment_id', $payment_id);

        return redirect('/sales-payment');
    }

    public function detailSalesPayment($sales_payment_id)
    {
        $salespayment   = SalesPayment::select('sales_payment.*', 'core_payment.payment_name', 'system_user_seller.seller_name', 'system_user_buyer.buyer_name', 'sales.sales_no')
        ->join('sales', 'sales.sales_id', 'sales_payment.sales_id')
        ->join('core_payment', 'core_payment.payment_id', 'sales.payment_id')
        ->join('system_user_seller', 'system_user_seller.seller_id', 'sales.seller_id')
        ->join('system_user_buyer', 'system_user_buyer.buyer_id', 'sales.buyer_id')
        ->where('sales_payment.sales_payment_id',$sales_payment_id)
        ->first();

        return view('content/SalesPayment/FormDetailSalesPayment',compact('salespayment'));
    }

    public function getItemVariantName($item_variant_id){
        $itemvariant = InvtItemVariant::select('item_variant_name')
        ->where('item_variant_id', $item_variant_id)
        ->first();

        return $itemvariant['item_variant_name'];
    }
}
