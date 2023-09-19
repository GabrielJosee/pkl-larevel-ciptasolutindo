@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Jadwal</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Jadwal</b> <small>Mengelola Jadwal Latihan</small>
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
                <button onclick="location.href='{{ url('/jadwal/tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Jadwal Baru</button>
                <button onclick="location.href='{{ url('/CetakJadwal') }}'" class="btn btn-sm btn-info" title="Add Data"
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
                            <th style='text-align:center'>Nama Latihan</th>
                            <th style='text-align:center'>Tempat Latihan</th>
                            <th style='text-align:center'>Hari Latihan</th>
                            <th style='text-align:center'>Jam Mulai</th>
                            <th style='text-align:center'>Jam Selesai</th>
                            <th style='text-align:center'>Deskripsi</th>
                            <th style='text-align:center'>Tim</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($jadwal as $jdl)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}</td>
                                <td style='text-align:center' width='10%'>{{ $jdl['name_training'] }}</td>
                                <td style='text-align:center' width='10%'>
                                    {{ $jdl->CallTraining['training_ground_name'] }}</td>
                                @if ($jdl['training_day'] == 1)
                                    <td style='text-align:center' width='10%'>Senin</td>
                                @elseif ($jdl['training_day'] == 2)
                                    <td style='text-align:center' width='10%'>Selasa</td>
                                @elseif ($jdl['training_day'] == 3)
                                    <td style='text-align:center' width='10%'>Rabu</td>
                                @elseif ($jdl['training_day'] == 4)
                                    <td style='text-align:center' width='10%'>Kamis</td>
                                @elseif ($jdl['training_day'] == 5)
                                    <td style='text-align:center' width='10%'>Jum'at</td>
                                @elseif ($jdl['training_day'] == 6)
                                    <td style='text-align:center' width='10%'>Sabtu</td>
                                @elseif ($jdl['training_day'] == 7)
                                    <td style='text-align:center' width='10%'>Minggu</td>
                                @endif
                                <td style='text-align:center' width='10%'>{{ $jdl['start_time'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $jdl['end_time'] }}</td>
                                <td style='text-align:center' width='15%'>{{ $jdl['description'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $jdl->CallTim['team_name'] }}</td>
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/jadwal/edit/' . $jdl['timetable_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/jadwal/hapus/' . $jdl['timetable_id']) }}">Hapus</a>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/jadwal/detail/' . $jdl['timetable_id']) }}">Detail</a>
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
