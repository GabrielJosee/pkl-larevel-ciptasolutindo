@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('product') }}">Daftar Slide Show</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Slide</li>
    </ol>
  </nav>

  
@stop

@section('content')

<h3 class="page-title">
    Form Tambah Slide 
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
            <a href="{{ url('slideshow') }}" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</a>
        </div>
    </div>

    <form method=""  action="{{ url('/slide/tambah/process') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="pitcure" class="text-dark">Foto / Video <span class='red'> *</span></label>
                        <input class="form-control" type="file" name="pitcure" id="pitcure" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="description" class="text-dark">Keterangan<span class='red'> *</span></label>
                        <input class="form-control input-bb" type="text" name="description" id="description" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-md-line-input">
                        <label for="start_date" class="control-label">Tanggal Tayang<span class="required text-danger">*</span></label>
                        <input type="date" class="form-control form-control-inline input-medium date-picker input-date" name="start_date" id="start_date" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-md-line-input">
                        <label for="end_date" class="control-label">Tanggal Berakhir<span class="required text-danger">*</span></label>
                        <input type="date" class="form-control form-control-inline input-medium date-picker input-date" name="end_date" id="end_date" value=""/>
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
