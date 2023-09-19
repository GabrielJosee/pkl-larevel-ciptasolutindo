@extends('adminlte::page')

@section('title', 'Tanggapan')
@section('js')
@stop

@section('content_header')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('timbasket') }}">Daftar Tim basket</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Tim </li>
        </ol>
    </nav>


@stop

@section('content')

    <h3 class="page-title">
        Form Detail Tim Basket
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
                Detail Tim Basket
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('timbasket') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form>
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">ID</a>
                            <input class="form-control input-bb" type="number" name="id_player" id="id_player"
                                value="{{ $timplay['id_team'] }}" autocomplete="off" readonly />

                            {{-- <input class="form-control input-bb" type="hidden" name="sales_id" id="sales_id" value="{{$salespayment['sales_id']}}"/> --}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Nama Tim</a>
                            <input class="form-control input-bb" type="text" name="team_name" id="team_name"
                                value="{{ $timplay->CallTeam['team_name'] }}" autocomplete="off" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Nama Player</a>
                            <input class="form-control input-bb" type="text" name="player_name" id="player_name"
                                value="{{ $timplay->CallPlayer['player_name'] }}" autocomplete="off" readonly />
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
