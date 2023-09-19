@inject('Sales', 'App\Http\Controllers\SalesController')

@extends('adminlte::page')

@section('title', 'Tanggapan')    
@section('js')
@stop

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('sales-payment') }}">Daftar Pembayaran</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Pembayaran</li>
    </ol>
</nav>

@stop

@section('content')

<h3 class="page-title">
    Form Detail Pembayaran
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
            Detail Pembayaran
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('sales-payment') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <form>
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">No Pembayaran</a>
                        <input class="form-control input-bb" type="text" name="sales_payment_no" id="sales_payment_no" value="{{$salespayment['sales_payment_no']}}" autocomplete="off" readonly/>

                        <input class="form-control input-bb" type="hidden" name="sales_id" id="sales_id" value="{{$salespayment['sales_id']}}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Seller</a>
                        <input class="form-control input-bb" type="text" name="seller_name" id="seller_name" value="{{$salespayment['seller_name']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Buyer</a>
                        <input class="form-control input-bb" type="text" name="buyer_name" id="buyer_name" value="{{$salespayment['buyer_name']}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">No Penjualan</a>
                        <input class="form-control input-bb" type="text" name="sales_no" id="sales_no" value="{{$salespayment['sales_no']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Metode Pembayaran</a>
                        <input class="form-control input-bb" type="text" name="payment_name" id="payment_name" value="{{$salespayment['payment_name']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Tgl Pembayaran</a>
                        <input class="form-control input-bb" type="text" name="created_at" id="created_at" value="{{$salespayment['created_at']}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <div class="form-group">
                        <a class="text-dark">Total Harga</a>
                        <input class="form-control input-bb" type="text" name="sales_payment_amount" id="sales_payment_amount" value="{{number_format($salespayment['sales_payment_amount'])}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>

@stop

@section('footer')
    
@stop

@section('css')
    
@stop