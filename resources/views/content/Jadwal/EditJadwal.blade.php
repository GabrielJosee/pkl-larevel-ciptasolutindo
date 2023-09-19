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
        Form Edit Jadwal
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
                <button onclick="location.href='{{ url('jadwal') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
            </div>
        </div>

        <form method="post" action="{{ url('/jadwal/edit/process/' . $jadwal['timetable_id']) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Nama Latihan<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="name_training" id="name_training"
                                value="{{ $jadwal['name_training'] }}" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <a class="text-dark">Tempat Latihan<a class='red'> *</a></a>
                            <select class="selection-search-clear" aria-label="Default select example" name="training_ground_id"
                                style="width: 100% !important">
                                @foreach ($TrainingGround as $TG)
                                    <option value="{{ $TG['training_ground_id'] }}"
                                        {{ $TG->training_ground_name == $trn ? 'selected' : '' }}>
                                        {{ $TG['training_ground_name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Hari Latihan<a class='red'> *</a></a>
                            <select class="form-control" type="text" name="training_day"
                                value="{{ $jadwal['training_day'] }}" autocomplete="off">
                                @if ($jadwal['training_day'] == 1)
                                    <option value="1" selected>Senin</option>
                                    <option value="2">Selasa</option>
                                    <option value="3">Rabu</option>
                                    <option value="4">Kamis</option>
                                    <option value="5">Jum'at</option>
                                    <option value="6">Sabtu</option>
                                    <option value="7">Minggu</option>
                                @elseif ($jadwal['training_day'] == 2)
                                    <option value="2"selected>Selasa</option>
                                    <option value="1">Senin</option>
                                    <option value="3">Rabu</option>
                                    <option value="4">Kamis</option>
                                    <option value="5">Jum'at</option>
                                    <option value="6">Sabtu</option>
                                    <option value="7">Minggu</option>
                                @elseif ($jadwal['training_day'] == 3)
                                    <option value="3"selected>Rabu</option>
                                    <option value="1">Senin</option>
                                    <option value="2">Selasa</option>
                                    <option value="4">Kamis</option>
                                    <option value="5">Jum'at</option>
                                    <option value="6">Sabtu</option>
                                    <option value="7">Minggu</option>
                                @elseif ($jadwal['training_day'] == 4)
                                    <option value="4"selected>Kamis</option>
                                    <option value="1">Senin</option>
                                    <option value="2">Selasa</option>
                                    <option value="3">Rabu</option>
                                    <option value="5">Jum'at</option>
                                    <option value="6">Sabtu</option>
                                    <option value="7">Minggu</option>
                                @elseif ($jadwal['training_day'] == 5)
                                    <option value="5"selected>Jum'at</option>
                                    <option value="1">Senin</option>
                                    <option value="2">Selasa</option>
                                    <option value="3">Rabu</option>
                                    <option value="4">Kamis</option>
                                    <option value="6">Sabtu</option>
                                    <option value="7">Minggu</option>
                                @elseif ($jadwal['training_day'] == 6)
                                    <option value="6"selected>Sabtu</option>
                                    <option value="1">Senin</option>
                                    <option value="2">Selasa</option>
                                    <option value="3">Rabu</option>
                                    <option value="4">Kamis</option>
                                    <option value="5">Jum'at</option>
                                    <option value="7">Minggu</option>
                                @elseif ($jadwal['training_day'] == 7)
                                    <option value="7"selected>Minggu</option>
                                    <option value="1">Senin</option>
                                    <option value="2">Selasa</option>
                                    <option value="3">Rabu</option>
                                    <option value="4">Kamis</option>
                                    <option value="5">Jum'at</option>
                                    <option value="6">Sabtu</option>
                                @else
                                    <option value="1">Senin</option>
                                    <option value="2">Selasa</option>
                                    <option value="3">Rabu</option>
                                    <option value="4">Kamis</option>
                                    <option value="5">Jum'at</option>
                                    <option value="6">Sabtu</option>
                                    <option value="7">Minggu</option>
                                @endif
                            </select>
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
                                type="text" name="start_time" id="start_time" value="{{ $jadwal['start_time'] }}" />
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
                                type="text" name="end_time" id="end_time" value="{{ $jadwal['end_time'] }}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Deskripsi<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="description" id="description"
                                value="{{ $jadwal['description'] }}" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <a class="text-dark">Tim<a class='red'> *</a></a>
                            <select class="selection-search-clear" name="id_team" style="width: 100% !important">
                                @foreach ($timbasket as $TB)
                                    <option value="{{ $TB['id_team'] }}"
                                        {{ $TB->team_name == $tm ? 'selected' : '' }}>
                                        {{ $TB['team_name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                            class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-primary" title="Save"><i
                            class="fa fa-check"></i> Simpan</button>
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
