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
        Form Detail Jadwal
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
                Form Detail
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('jadwal') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="post" action="/system-user/process-" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Nama Latihan</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $jadwal['name_training'] }}" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Tempat Latihan</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $jadwal->CallTraining['training_ground_name'] }}" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Hari Latihan</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $jadwal['training_day'] }}" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Jam Mulai</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $jadwal['start_time'] }}" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Jam Selesai</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $jadwal['end_time'] }}" readonly />
                        </div>
                    </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Deskripsi</a>
                        <input class="form-control input-bb" type="text" name="name" id="name"
                            value="{{ $jadwal['description'] }}" readonly />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama TIM</a>
                        <input class="form-control input-bb" type="text" name="team_name" id="team_name"
                            value="{{ $jadwal->CallTim['team_name'] }}" readonly />
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
