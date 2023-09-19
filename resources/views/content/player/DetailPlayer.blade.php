@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('product') }}">Daftar Player</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Player</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Detail Player
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
            Form Detail
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('player') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <form method="post" action="/system-user/process-" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">ID Pemain</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $player['id_player'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Pemain</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $player['player_name'] }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Tempat Lahir</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $player['birth_place'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Tanggal Lahir</a>
                        <input class="form-control input-bb" type="date" name="name" id="name" value="{{ $player['date_birth'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Alamat</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $player['player_address'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="text-dark">Foto Pemain</label>
                        @if ($player['player_image'])
                            <img src="{{ asset('images/' . $player['player_image']) }}" alt="Foto Pemain" class="img-fluid">
                        @else
                            Tidak ada gambar pemain yang dipilih.
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Jenis Kelamin</a>
                        <input class="form-control input-bb" type="text" name="player_gender" id="player_gender" value=
                        "@if ($player['player_gender'] == 1)Laki - laki 
                        @elseif($player['player_gender'] == 2)Perempuan
                    @endif
                        " autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Posisi Pemain</a>
                        <input class="form-control input-bb" type="text" name="player_position" id="player_position" value=
                        "@if ($player['player_position'] == 1)Point Guard
                        @elseif($player['player_position'] == 2)Shooting Guard
                        @elseif($player['player_position'] == 3)Small Forward
                        @elseif($player['player_position'] == 4)Power Forward
                        @elseif($player['player_position'] == 5)Center
                    @endif
                        " autocomplete="off" readonly/>
                    </div>
                </div>
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