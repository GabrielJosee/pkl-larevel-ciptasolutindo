@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('productcategory') }}">Daftar Jadwal Latihan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Jadwal Latihan</li>
        </ol>
    </nav>


@stop

@section('content')

    <h3 class="page-title">
        Form Tambah Jadwal Latihan
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
                Form Tambah
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('jadwal') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
            </div>
        </div>

        <form method="POST" action="{{url('/jadwal/tambah/process')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Nama Latihan<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="name_training" id="name_training"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <a class="text-dark">Tempat Latihan<a class='red'> *</a></a>
                            <select class="selection-search-clear select-form" name="training_ground_id" style="width: 100% !important">
                                <option value="" selected disabled>Pilih Tempat Latihan</option>
                                @foreach ($TrainingGround as $TG)
                                    <option value="{{ $TG->training_ground_id }}">{{ $TG->training_ground_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Hari Latihan<a class='red'> *</a></a>
                            <select class="selection-search-clear select-form" name="training_day" id="training_day" style="width: 100% !important">
                                <option value="" selected disabled>Pilih Hari</option>
                                <option value="1">Senin</option>
                                <option value="2">Selasa</option>
                                <option value="3">Rabu</option>
                                <option value="4">Kamis</option>
                                <option value="5">Jum'at</option>
                                <option value="6">Sabtu</option>
                                <option value="7">Minggu</option>
                              </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <section class="control-label">Jam Mulai
                                <span class="required text-danger">
                                    *
                                </span>
                            </section>
                            <input type="time"
                                class="form-control form-control-inline input-medium date-picker input-date"
                                name="start_time" id="start_time" value="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <section class="control-label">Jam Selesai
                                <span class="required text-danger">
                                    *
                                </span>
                            </section>
                            <input type="time"
                                class="form-control form-control-inline input-medium date-picker input-date" name="end_time"
                                id="end_time" value="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Deskripsi<a class='red'> *</a></a>
                            <textarea rows="5" cols="" rows="" class="form-control input-bb" name="description"
                                id="description"></textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <a class="text-dark">Tim<a class='red'> *</a></a>
                            <select class="selection-search-clear" name="id_team"
                                style="width: 100% !important">
                                <option value="" selected disabled>Pilih Tim</option>
                                @foreach ($timbasket as $TB)
                                    <option value="{{ $TB->id_team }}">{{ $TB->team_name }}</option>
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
                    <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i>
                        Simpan</button>
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
