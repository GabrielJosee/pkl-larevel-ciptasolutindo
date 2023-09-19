@extends('adminlte::page')

@section('title', 'Tanggapan')
@section('js')
@stop

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('timbasket') }}">Daftar Tim Basket</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Tim</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Edit Tim Basket
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif

    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Form Edit
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('timbasket') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="post" action="{{ url('/timbasket/edit/process/' . $id_team_play) }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Nama Tim<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="team_name" id="team_name" value="{{ $timplay->CallTeam['team_name'] }}"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Tim<a class='red'> *</a></a>
                            <select class="form-control" aria-label="Default select example" name="id_team">
                                @foreach ($timbasket as $TM)
                                    <option value="{{ $TM['id_team'] }}" {{ $TM->team_name == $relatedTeamName ? 'selected' : '' }}>
                                        {{ $TM['team_name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Pemain<a class='red'> *</a></a>
                            <select class="form-control" aria-label="Default select example" name="id_player">
                                @foreach ($player as $BOLA)
                                    <option value="{{ $BOLA->id_player }}" {{ $BOLA->player_name == $relatedPlayerName ? 'selected' : '' }}>
                                        {{ $BOLA->player_name }}
                                    </option>
                                @endforeach
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
