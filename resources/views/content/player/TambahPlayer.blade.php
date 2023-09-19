@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('product') }}">Daftar Pemain</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Pemain</li>
    </ol>
  </nav>

  
@stop

@section('content')

<h3 class="page-title">
    Form Tambah Pemain 
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

    <form method="POST"  action="{{ url('/player/tambah/process') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="player_name" class="text-dark">Nama Player<span class='red'> *</span></label>
                        <input class="form-control input-bb" type="text" name="player_name" id="player_name" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="birth_place" class="text-dark">Tempat Lahir<span class='red'> *</span></label>
                        <input class="form-control input-bb" type="text" name="birth_place" id="birth_place" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-md-line-input">
                        <label for="date_birth" class="control-label">Tanggal Lahir<span class="required text-danger">*</span></label>
                        <input type="date" class="form-control form-control-inline input-medium date-picker input-date" name="date_birth" id="date_birth" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="player_address" class="text-dark">Alamat<span class='red'> *</span></label>
                        <input class="form-control input-bb" type="text" name="player_address" id="player_address" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="player_image" class="text-dark">Foto Pemain<span class='red'> *</span></label>
                        <input class="form-control" type="file" name="player_image" id="player_image" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="player_gender" class="text-dark">Jenis Kelamin<span class='red'> *</span></label>
                    <select class="selection-search-clear" name="player_gender" id="player_gender" style="width: 100% !important">
                      <option value="1">Laki Laki</option>
                      <option value="2">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="player_position" class="text-dark">Posisi Pemain<span class='red'> *</span></label>
                    <select class="selection-search-clear" name="player_position" id="player_position" style="width: 100% !important">
                        <option value="" selected disabled>Pilih Posisi</option>
                      <option value="1">Point Guard</option>
                      <option value="2">Shooting Guard</option>
                      <option value="3">Small Forward</option>
                      <option value="4">Power Forward</option>
                      <option value="5">Center</option>
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
