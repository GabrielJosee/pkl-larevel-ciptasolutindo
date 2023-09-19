@inject('SalesSchedule', 'App\Http\Controllers\SalesScheduleController')

@extends('adminlte::page')

@section('title', 'Tanggapan')    
@section('js')
@stop

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('sales-schedule') }}">Daftar Jadwal Tanggapan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Jadwal Tanggapan</li>
    </ol>
</nav>

@stop

@section('content')

<h3 class="page-title">
    Form Detail Jadwal Tanggapan
</h3>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif
    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                List Jadwal Tanggapan
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('sales-schedule') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
            </div>
        </div>
        <form>
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Seller</a>
                        <input class="form-control input-bb" type="text" name="seller_name" id="seller_name" value="{{$SalesSchedule->getSellerName($seller_id)}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Tanggal Mulai</a>
                        <input class="form-control input-bb" type="text" name="start-date" id="start-date" value="{{date('d M Y', strtotime($start_date))}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Tanggal Akhir</a>
                        <input class="form-control input-bb" type="text" name="end_date" id="end_date" value="{{date('d M Y', strtotime($end_date))}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
            <br/>
            <div class="table-responsive">
                <table style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="5%" style='text-align:center'>No</th>
                            <th width="15%" style='text-align:center'>Tanggal Mulai</th>
                            <th width="15%" style='text-align:center'>Tanggal Akhir</th>
                            <th width="10%" style='text-align:center'>No Penjualan</th>
                            <th width="20%" style='text-align:center'>Item</th>
                            <th width="20%" style='text-align:center'>Item Variant</th>
                            <th width="15%" style='text-align:center'>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(count($salesschedule)!=0){
                        $no = 1; 
                        ?>
                        @foreach($salesschedule as $item)
                        <tr>
                            <td align="center">{{$no}}</td>
                            <td align="left">{{date('d M Y : H:i:s', strtotime($item['sales_schedule_start_date']))}}</td>
                            <td align="left">{{date('d M Y : H:i:s', strtotime($item['sales_schedule_end_date']))}}</td>
                            <td align="left">{{$SalesSchedule->getSalesNo($item['sales_id'])}}</td>
                            <td align="left">{{$SalesSchedule->getItemName($item['sales_item_id'])}}</td>
                            <td align="left">{{$SalesSchedule->getItemVariantName($item['sales_item_id'])}}</td>
                            <td align="left">{{$salesschedulestatus[$item['sales_schedule_status']]}}</td>
                        </tr>
                        <?php $no++ ?>
                        @endforeach
                        <?php }else{?>
                        <tr>
                            <td align="center" colspan="7">Data Kosong</td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>

@stop

@section('footer')
    
@stop

@section('css')
    
@stop