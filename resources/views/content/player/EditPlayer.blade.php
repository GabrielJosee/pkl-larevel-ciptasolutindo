@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('product') }}">Daftar Pemain</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Pemain</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Edit Pemain
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
            <button onclick="location.href='{{ url('player') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
        </div>
    </div>

    <form method="POST" action="{{ url('/player/edit/process/' . $player['id_player']) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Pemain<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="player_name" id="player_name" value="{{ $player['player_name'] }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Tempat Lahir<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="birth_place" id="birth_place" value="{{ $player['birth_place'] }}"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-md-line-input">
                        <section class="control-label">Tanggal Lahir
                            <span class="required text-danger">
                                *
                            </span>
                        </section>
                        <input type="date"
                            class="form-control form-control-inline input-medium date-picker input-date"
                            type="text" name="date_birth" id="date_birth" value="{{ $player['date_birth'] }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Alamat<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="player_address" id="player_address" value="{{ $player['player_address'] }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="text-dark">Foto Pemain<span class='red'> *</span></label>
                        <input class="form-control" type="file" accept="image/*" name="player_image" id="player_image" autocomplete="off">
                        
                        @if ($player['player_image'])
                            <img src="{{ asset('images/' . $player['player_image']) }}" alt="Foto Pemain" class="img-fluid">
                        @else
                            Tidak ada gambar pemain yang dipilih.
                        @endif
                    </div>
                </div>             
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Jenis Kelamin<a class='red'> *</a></a>
                        <select class="form-control" type="text" name="player_gender" value="{{$player['player_gender']}}" autocomplete="off">
                            @if ($player['player_gender'] == 1)
                            <option value="1" selected>Laki - laki</option>
                            <option value="2">Perempuan</option>
                        @elseif($customer['player_gender'] == 2)
                            <option value="2" selected>Perempuan</option>
                            <option value="1">Laki - laki</option>
                        @else
                            <option value="1">Laki - laki</option>
                            <option value="2">Perempuan</option>
                        @endif
                    </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Posisi Pemain<a class='red'> *</a></a>
                        <select class="form-control" type="text" name="player_position" value="{{$player['player_posiiton']}}" autocomplete="off">
                        @if ($player['player_position'] == 1)
                            <option value="1" selected>Point Guard</option>
                            <option value="2">Shooting Guard</option>
                            <option value="3">Small Forward</option>
                            <option value="4">Power Forward</option>
                            <option value="5">Center</option>
                        @elseif($player['player_position'] == 2)
                            <option value="2" selected>Shooting Guard</option>
                            <option value="1">Point Guard</option>
                            <option value="3">Small Forward</option>
                            <option value="4">Power Forward</option>
                            <option value="5">Center</option>
                        @elseif($player['player_position'] == 3)
                            <option value="3" selected>Small Forward</option>
                            <option value="2">Shooting Guard</option>
                            <option value="1">Point Guard</option>
                            <option value="4">Power Forward</option>
                            <option value="5">Center</option>
                        @elseif($player['player_position'] == 4)
                            <option value="4" selected>Power Forward</option>
                            <option value="3">Small Forward</option>
                            <option value="2">Shooting Guard</option>
                            <option value="1">Point Guard</option>
                            <option value="5">Center</option>
                        @elseif($player['player_position'] == 5)
                            <option value="5" selected>Center</option>
                            <option value="4">Power Forward</option>
                            <option value="3">Small Forward</option>
                            <option value="2">Shooting Guard</option>
                            <option value="1">Point Guard</option>
                        
                        @else
                            <option value="1">Point Guard</option>
                            <option value="2">Shooting Guard</option>
                            <option value="3">Small Forward</option>
                            <option value="4">Power Forward</option>
                            <option value="5">Center</option>
                        @endif
                    </select>
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