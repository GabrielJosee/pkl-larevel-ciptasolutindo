@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('productcategory') }}">Daftar Tempat Latihan</a></li>
       <li class="breadcrumb-item active" aria-current="page">Edit Tempat Latihan</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Edit Tempat Latihan
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
            Form Edit
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('training') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
        </div>
    </div>

    <form method="post" action="{{ url('/training/edit/process/' . $training['training_ground_id']) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Temapat Latihan<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="training_ground_name" id="training_ground_name" value="{{ $training['training_ground_name'] }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Alamat<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="training_ground_address" id="training_groud_address" value="{{ $training['training_ground_address'] }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Kontak Person<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="contact_person" id="contact_person" value="{{ $training['contact_person'] }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">No HP<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="number_phone" id="number_phone" value="{{ $training['number_phone'] }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                        <div class="form-group form-md-line-input">
                            <section class="control-label">Jam Buka
                                <span class="required text-danger">
                                    *
                                </span>
                            </section>
                            <input type="time"
                                class="form-control form-control-inline input-medium date-picker input-date"
                                type="text" name="open_hours" id="open_hours" value="{{ $training['open_hours'] }}"/>
                        </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-md-line-input">
                        <section class="control-label">Jam Tutup
                            <span class="required text-danger">
                                *
                            </span>
                        </section>
                        <input type="time"
                            class="form-control form-control-inline input-medium date-picker input-date"
                            type="text" name="close_hours" id="close_hours" value="{{ $training['close_hours'] }}"/>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="form-actions float-right">
                <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
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

@section('js')
    
@stop