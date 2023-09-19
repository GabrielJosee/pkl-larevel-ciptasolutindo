@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('productcategory') }}">Daftar Kegiatan Jadwal Latihan</a></li>
       <li class="breadcrumb-item active" aria-current="page">Edit Kegiatan Jadwal Latihan</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Edit Kegiatan
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
            <button onclick="location.href='{{ url('kegiatan') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
        </div>
    </div>

    <form method="post" action="{{ url('/kegiatan/edit/process/' . $kegiatan['activity_id']) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group form-md-line-input">
                        <a class="text-dark">Jadwal Latihan<a class='red'> *</a></a>
                        <select class="selection-search-clear select-form" name="timetable_id"
                            style="width: 100% !important">
                            <option value="" selected disabled>Pilih Jadwal</option>
                            @foreach ($jadwal as $JL)
                                <option value="{{ $JL->timetable_id}}" {{ $JL->name_training == $TraName ? 'selected' : '' }}>
                                    {{ $JL->name_training }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Kegiatan<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="activity_name" id="activity_name" value="{{ $kegiatan['activity_name'] }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-md-line-input">
                        <section class="control-label">Jam Mulai
                            <span class="required text-danger">
                                *
                            </span>
                        </section>
                        <input type="time"
                        class="form-control form-control-inline input-medium date-picker input-date"
                        type="text" name="activity_start" id="activity_start" value="{{ $kegiatan['activity_start'] }}"/>
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
                        type="text" name="activity_end" id="activity_end" value="{{ $kegiatan['activity_end'] }}"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <a class="text-dark">Deskripsi<a class='red'> *</a></a>
                    <input class="form-control input-bb" type="text" name="description_act" id="description_act" value="{{ $kegiatan['description_act'] }}"/>
                </div>
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