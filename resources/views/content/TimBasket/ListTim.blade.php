@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Tim Basket</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Tim Basket</b> <small>Mengelola Tim Basket </small>
    </h3>
    <br />

    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ session('message') }}
        </div>
    @endif

    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('/timbasket/tambah') }}'" name="" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Tim Baru</button>
                <button onclick="location.href='{{ url('/cetak-tim') }}'" class="btn btn-sm btn-info" title="Add Data"
                    style="margin-left: 5px">Print PDF
                </button>
                <button onclick="location.href='{{ url('/cetak-timbasket-excel') }}'" class="btn btn-sm btn-info"
                    title="Add Data" style="margin-left: 5px">Print Excel
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Nama Tim</th>
                            <th style='text-align:center'>Nama Pemain</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($timplay as $tim)
                            <tr>
                                <td style='text-align:center' width='10%'>{{ $no }}</td>
                                <td style='text-align:center' width='15%'>{{ $tim->CallTeam['team_name']}}</td>
                                <td style='text-align:center' width='15%'>{{ $tim->CallPlayer['player_name']}}</td>
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/timbasket/edit/' . $tim['id_team_play']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/timbasket/detail/' . $tim['id_team_play']) }}">Detail</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/timbasket/hapus/' . $tim['id_team_play']) }}">Hapus</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
