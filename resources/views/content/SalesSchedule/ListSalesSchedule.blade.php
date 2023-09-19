@inject('SalesSchedule', 'App\Http\Controllers\SalesScheduleController')

@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('js')

@stop

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Jadwal Tanggapan</li>
    </ol>
</nav>

@stop

@section('content')

<h3 class="page-title">
    <b>Daftar Jadwal Tanggapan</b> <small>Mengelola Jadwal Tanggapan</small>
</h3>
<br/>
<div id="accordion">
    <form  method="post" action="{{route('filter-sales-schedule')}}" enctype="multipart/form-data">
    @csrf
        <div class="card border border-dark">
        <div class="card-header bg-dark" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <h5 class="mb-0">
                Filter
            </h5>
        </div>
    
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <div class = "row">
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <section class="control-label">Tanggal Mulai
                                <span class="required text-danger">
                                    *
                                </span>
                            </section>
                            <input type ="date" class="form-control form-control-inline input-medium date-picker input-date" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date" onChange="function_elements_add(this.name, this.value);" value="{{$start_date}}" style="width: 15rem;"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <section class="control-label">Tanggal Akhir
                                <span class="required text-danger">
                                    *
                                </span>
                            </section>
                            <input type ="date" class="form-control form-control-inline input-medium date-picker input-date" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" onChange="function_elements_add(this.name, this.value);" value="{{$end_date}}" style="width: 15rem;"/>
                        </div>
                    </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Find" class="btn btn-primary" title="Search Data"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </div>
        </div>
    </form>
</div>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif 
<div class="card border border-dark">
    <div class="card-header bg-dark clearfix">
        <h5 class="mb-0 float-left">
            Daftar
        </h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <th width="5%" style='text-align:center'>No</th>
                        <th width="20%" style='text-align:center'>Nama Seller</th>
                        <th width="15%" style='text-align:center'>Dijalankan</th>
                        <th width="15%" style='text-align:center'>Dibatalkan</th>
                        <th width="15%" style='text-align:center'>Akan Datang</th>
                        <th width="15%" style='text-align:center'>Total Acara</th>
                        <th width="5%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach($seller as $item)
                    <?php 
                        $dijalankan = $SalesSchedule->getSalesScheduleDijalankan($start_date, $end_date);
                        $dibatalkan = $SalesSchedule->getSalesScheduleDibatalkan($start_date, $end_date);
                        $akandatang = $SalesSchedule->getSalesScheduleAkanDatang($start_date, $end_date);
                        $totalacara = $dijalankan + $dibatalkan + $akandatang;
                    ?>
                    <tr>
                        <td style='text-align:center'>{{$no}}</td>
                        <td>{{$item['seller_name']}}</td>
                        <td>{{$dijalankan}}</td>
                        <td>{{$dibatalkan}}</td>
                        <td>{{$akandatang}}</td>
                        <td>{{$totalacara}}</td>
                        <td class="">
                            <a type="button" class="btn btn-outline-warning btn-sm" href="{{ url('/sales-schedule/detail/'.$item['seller_id']) }}">Detail</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>

@stop

@section('footer')
    
@stop

@section('css')
    
@stop