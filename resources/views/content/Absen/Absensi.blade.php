@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('absensi') }}">Riwayat Absensi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Absensi</li>
        </ol>
    </nav>
@stop

@section('content')

    <h3 class="page-title">
        Form Absensi
    </h3>
    <br />
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif

    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Absensi
            </h5>
        </div>

        <form method="POST" action="{{ url('/absensi/absen') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <a class="text-dark">Latihan<a class='red'> *</a></a>
                            @if ($jadwal->first())
                                <input type="hidden" name="timetable_id" value="{{ $jadwal->first()->timetable_id }}">
                                <p class="form-control-static">{{ $jadwal->first()->name_training }}</p>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <a class="text-dark">Pemain<a class='red'> *</a></a>
                            <input type="hidden" name="id_player"
                                value="{{ Auth::user()->team ? Auth::user()->team->id_team : '' }}">

                            <p class="form-control-static">{{ Auth::user()->full_name }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <section class="control-label">Tanggal dan Jam<span class="required text-danger">*</span>
                            </section>
                            <input type="datetime-local"
                                class="form-control form-control-inline input-medium date-picker input-date"
                                name="attendance_datetime" id="attendance_datetime" value="{{ $currentDateTime }}"
                                readonly />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions text-center">
                    <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i>
                        Simpan</button>
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
