@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('product') }}">Daftar Kategori Penilaian Kesehatan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Kategori Penilaian Kesehatan</li>
    </ol>
  </nav>

  
@stop

@section('content')

<h3 class="page-title">
    Form Tambah Kategori Penilaian Kesehatan  
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
            <a href="{{ url('kategorikesehatan') }}" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</a>
        </div>
    </div>

    <form method="POST"  action="{{ url('/kategorikesehatan/tambah/process') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="kode_assessment" class="text-dark">Kode<span class='red'> *</span></label>
                        <input class="form-control input-bb" type="text" name="kode_assessment" id="kode_assessment" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name_assessment" class="text-dark">Nama<span class='red'> *</span></label>
                        <input class="form-control input-bb" type="text" name="name_assessment" id="name_assessment" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="information_assessment" class="text-dark">Keterangan<span class='red'> *</span></label>
                        <input class="form-control input-bb" type="text" name="information_assessment" id="information_assessment" value=""/>
                    </div>
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
