@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Latihan</li>
    </ol>
</nav>

@stop

@section('content')

<h3 class="page-title">
    <b>Daftar Latihan</b> <small>Mengelola Tempat Latihan</small>
</h3>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@if (session('message'))
<div class="alert alert-info" role="alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    {{ session('message') }}
</div>
@endif
@endif 
<div class="card border border-dark">
    <div class="card-header bg-dark clearfix">
        <h5 class="mb-0 float-left">
            Daftar
        </h5>
        <div class="form-actions float-right">
            <button onclick="location.href='{{ url('/training/tambah') }}'" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Gudang Baru</button>
        </div>
    </div>
<div class="card-body">
    <div class="table-responsive">    
        <table id="example" style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
        <thead>
            <tr>
                    <th style='text-align:center'>No</th>
                    <th style='text-align:center'>Nama Tempat Latihan</th>
                    <th style='text-align:center'>Alamat</th>
                    <th style='text-align:center'>Kontak Person</th>
                    <th style='text-align:center'>No HP</th>
                    <th style='text-align:center'>Jam Buka</th>
                    <th style='text-align:center'>Jam Tutup</th>
                    <th style='text-align:center'>Aksi</th>
                </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach($training as $trg)
            <tr>
                <td style='text-align:center' width='10%'>{{ $no }}</td>
                <td style='text-align:center' width='15%'>{{ $trg['training_ground_name'] }}</td>
                <td style='text-align:center' width='15%'>{{ $trg['training_ground_address'] }}</td>
                <td style='text-align:center' width='15%'>{{ $trg['contact_person'] }}</td>
                <td style='text-align:center' width='10%'>{{ $trg['number_phone']}}</td>
                <td style='text-align:center' width='10%'>{{ $trg['open_hours']}}</td>
                <td style='text-align:center' width='10%'>{{ $trg['close_hours']}}</td>
                <td style='text-align:center' width='15%'>
                    <a type="button" class="btn btn-outline-warning btn-sm"
                    href="{{ url('/training/edit/' . $trg['training_ground_id']) }}">Edit</a>
                    <a type="button" class="btn btn-outline-danger btn-sm"
                    href="{{ url('/training/hapus/' . $trg['training_ground_id']) }}">Hapus</a>
                    <a type="button" class="btn btn-outline-info btn-sm"
                    href="{{ url('/training/detail/' . $trg['training_ground_id']) }}">Detail</a>
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
  
  @section('js')
      
  @stop