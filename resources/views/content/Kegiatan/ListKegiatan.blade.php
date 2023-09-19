@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Kegiatan</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Kegiatan</b> <small>Mengelola Kegiatan Jadwal Latihan</small>
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
        @if (session('message'))
            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session('message') }}
            </div>
        @endif
    @endif
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('/kegiatan/tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Kegiatan Baru</button>
                <button onclick="location.href='{{ url('/CetakKegiatan') }}'" class="btn btn-sm btn-info" title="Add Data"
                    style="margin-left: 5px">Print PDF
                    <button onclick="location.href='{{ url('/CetakExcel') }}'" class="btn btn-sm btn-info" title="Add Data"
                        style="margin-left: 5px">Print Excel
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Latihan</th>
                            <th style='text-align:center'>Kegiatan</th>
                            <th style='text-align:center'>Jam Mulai</th>
                            <th style='text-align:center'>Jam Selesai</th>
                            <th style='text-align:center'>Deskripsi</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($kegiatan as $kgn)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}</td>
                                <td style='text-align:center' width='10%'>{{ $kgn->CallJadwalLat['name_training'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $kgn['activity_name'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $kgn['activity_start'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $kgn['activity_end'] }}</td>
                                <td style='text-align:center' width='15%'>{{ $kgn['description_act'] }}</td>
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/kegiatan/edit/' . $kgn['activity_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/kegiatan/hapus/' . $kgn['activity_id']) }}">Hapus</a>
                                    {{-- <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/kegiatan/detail/' . $kgn['activity_id']) }}">Detail</a> --}}
                                </td>
                            </tr>
                            <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
