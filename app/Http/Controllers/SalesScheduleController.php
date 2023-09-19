<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PublicController;
use App\Models\InvtItemVariant;
use App\Models\Sales;
use App\Models\SalesItem;
use App\Models\CorePayment;
use App\Models\SystemUserSeller;
use App\Models\SalesSchedule;
use Illuminate\Support\Facades\Session;
use App\Helpers\Configuration;

class SalesScheduleController extends PublicController
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

        $seller     = SystemUserSeller::select('system_user_seller.*', 'system_user.name')
        ->join('system_user', 'system_user.user_id', 'system_user_seller.user_id')
        ->where('system_user.seller_status', 1)
        ->where('system_user_seller.data_state', 0)
        ->get();

        return view('content/SalesSchedule/ListSalesSchedule',compact('seller', 'start_date', 'end_date'));
    }

    public function filter(Request $request){
        $start_date   = $request->start_date;
        $end_date     = $request->end_date;

        Session::put('start_date', $start_date);
        Session::put('end_date', $end_date);

        return redirect('/sales-schedule');
    }

    public function detailSalesSchedule($seller_id)
    {
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

        $salesschedule = SalesSchedule::select('sales_schedule.*')
        ->where('sales_schedule.seller_id',$seller_id)
        ->where('sales_schedule.sales_schedule_start_date','>=', $start_date)
        ->where('sales_schedule.sales_schedule_end_date','<=', $stop_date)
        ->get();

        $salesschedulestatus = Configuration::getSalesScheduleStatus();

        return view('content/SalesSchedule/FormDetailSalesSchedule',compact('salesschedule', 'seller_id', 'start_date', 'end_date', 'salesschedulestatus'));
    }

    public function getSalesNo($sales_id){
        $sales = Sales::select('sales_no')
        ->where('sales_id', $sales_id)
        ->first();

        return $sales['sales_no'];
    }

    public function getItemName($sales_item_id){
        $item = SalesItem::select('invt_item.item_name')
        ->join('invt_item', 'sales_item.item_id', 'invt_item.item_id')
        ->where('sales_item.sales_item_id', $sales_item_id)
        ->first();

        return $item['item_name'];
    }

    public function getItemVariantName($sales_item_id){
        $item = SalesItem::select('invt_item_variant.item_variant_name')
        ->join('invt_item_variant', 'sales_item.item_id', 'invt_item_variant.item_id')
        ->where('sales_item.sales_item_id', $sales_item_id)
        ->first();

        return $item['item_variant_name'];
    }

    public function getSellerName($seller_id){
        $seller = SystemUserSeller::select('seller_name')
        ->where('seller_id', $seller_id)
        ->first();

        return $seller['seller_name'];
    }

    public function getSalesScheduleDijalankan($start_date, $end_date){
        
        $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));

        $data = SalesSchedule::select('sales_schedule_id')
        ->where('sales_schedule.sales_schedule_status', 1)
        ->where('sales_schedule.sales_schedule_start_date','>=', $start_date)
        ->where('sales_schedule.sales_schedule_end_date','<=', $stop_date)
        ->get();

        return count($data);
    }

    public function getSalesScheduleDibatalkan($start_date, $end_date){
        
        $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));

        $data = SalesSchedule::select('sales_schedule_id')
        ->where('sales_schedule.sales_schedule_status', 2)
        ->where('sales_schedule.sales_schedule_start_date','>=', $start_date)
        ->where('sales_schedule.sales_schedule_end_date','<=', $stop_date)
        ->get();

        return count($data);
    }

    public function getSalesScheduleAkanDatang($start_date, $end_date){
        
        $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));

        $data = SalesSchedule::select('sales_schedule_id')
        ->where('sales_schedule.sales_schedule_status', 0)
        ->where('sales_schedule.sales_schedule_start_date','>=', $start_date)
        ->where('sales_schedule.sales_schedule_end_date','<=', $stop_date)
        ->get();

        return count($data);
    }
}
