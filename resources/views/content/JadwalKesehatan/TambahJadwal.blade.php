@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('product') }}">Daftar Jadwal Penilaian Kesehatan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Jadwal Penilaian Kesehatan</li>
    </ol>
  </nav>

  
@stop

@section('content')

<h3 class="page-title">
    Form Tambah Jadwal Penilaian Kesehatan 
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
            Form Tambah
        </h5>
        <div class="float-right">
            <a href="{{ url('player') }}" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</a>
        </div>
    </div>

    <form method="POST"  action="{{ url('/jadwalkesehatan/tambah/process') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-3">
                    <label for="month_period">Bulan Periode<span class='red'> *</span></label>
                    <select class="selection-search-clear" name="month_period" id="month_period" style="width: 100% !important">
                        <option value="" selected disabled>Pilih Posisi</option>
                      <option value="1">Januari</option>
                      <option value="2">Februari</option>
                      <option value="3">Maret</option>
                      <option value="4">April</option>
                      <option value="5">Mei</option>
                      <option value="6">Juni</option>
                      <option value="7">Juli</option>
                      <option value="8">Agustus</option>
                      <option value="9">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="year_period">Tahun Periode<span class='red'> *</span></label>
                    <select class="selection-search-clear" name="year_period" id="year_period" style="width: 100% !important">
                        <option value="" selected disabled>Pilih Posisi</option>
                      <option value="1">2020</option>
                      <option value="2">2021</option>
                      <option value="3">2022</option>
                      <option value="4">2023</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="form-actions float-right">
                <button type="reset" name="Reset" class="btn btn-danger"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
            </div>
        </div>
    </form>
</div>
@stop

@section('footer')
    
@stop

@section('css')
    
@stop

@section('js')
    
@stop
