@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('penilaiankesehatan') }}">Daftar Penilaian Kesehatan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Kategori Penilaian Kesehatan</li>
    </ol>
  </nav>

  
@stop

@section('content')

<h3 class="page-title">
    Form Tambah Penilaian Kesehatan  
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
            <a href="{{ url('penilaiankesehatan') }}" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</a>
        </div>
    </div>

    <form method="POST"  action="{{ url('/penilaiankesehatan/tambah/process') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="form-group form-md-line-input">
                            <a class="text-dark">Jadwal Penilaian Kesehatan<a class='red'> *</a></a>
                            <select class="selection-search-clear select-form" name="health_assessment_schedule_id"
                                style="width: 100% !important">
                                <option value="" selected disabled>Pilih Jadwal Penilaian Kesehatan</option>
                                @foreach ($jk as $JK)
                                    <option value="{{ $JK->health_assessment_schedule_id }}">{{ $monthname[$JK->month_period] }} {{ $yearnum[$JK->year_period] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="form-group form-md-line-input">
                            <a class="text-dark">Kategori Penilaian Kesehatan<a class='red'> *</a></a>
                            <select class="selection-search-clear select-form" name="health_assessment_categories_id"
                                style="width: 100% !important">
                                <option value="" selected disabled>Pilih Kategori Penilaian Kesehatan</option>
                                @foreach ($kt as $KT)
                                    <option value="{{ $KT->health_assessment_categories_id }}">{{ $KT->name_assessment }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="information_assessment" class="text-dark">Nilai<span class='red'> *</span></label>
                        <input class="form-control input-bb" type="number" name="mark_health" id="mark_health" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="form-group form-md-line-input">
                            <a class="text-dark">Pemain<a class='red'> *</a></a>
                            <select class="selection-search-clear select-form" name="id_player"
                                style="width: 100% !important">
                                <option value="" selected disabled>Pilih Pemain</option>
                                @foreach ($player as $plyr)
                                    <option value="{{ $plyr->id_player }}">{{ $plyr->player_name }}</option>
                                @endforeach
                            </select>
                        </div>
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
