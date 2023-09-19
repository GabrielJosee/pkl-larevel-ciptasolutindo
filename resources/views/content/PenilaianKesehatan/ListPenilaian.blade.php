@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Penilaian Kesehatan</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Penilaian Kesehatan</b> <small>Penilaian Kesehatan</small>
    </h3>
    <br />
    @if (session('msge'))
        <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ session('msge') }}
        </div>
    @endif
    @php
        $bulan = [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $tahun = [
            '1' => '2020',
            '2' => '2021',
            '3' => '2022',
            '4' => '2023',
        ]
    @endphp
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('penilaiankesehatan/tambah') }}'" name="Find"
                    class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah </button>
                <button onclick="location.href='{{ url('/CetakPenilaianKesehatan') }}'" class="btn btn-sm btn-info"
                    title="Add Data" style="margin-left: 5px">Print PDF
                    <button onclick="location.href='{{ url('/CetakPenilaianExcel') }}'" class="btn btn-sm btn-info"
                        title="Add Data" style="margin-left: 5px">Print Excel
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Jadwal Penilaian Kesehatan</th>
                            <th style='text-align:center'>Kategori Penilaian Kesehatan</th>
                            <th style='text-align:center'>Nilai</th>
                            <th style='text-align:center'>Pemain</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($pnl as $pl)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}</td>
                                <td style='text-align:center' width='15%'>
                                    {{ $bulan [$pl->CallJadwalKe['month_period']] }} {{ $tahun [$pl->CallJadwalKe['year_period']] }}
                                </td>
                                <td style='text-align:center' width='15%'>
                                    {{ $pl->CallKategoriKe['name_assessment'] }}</td>
                                <td style='text-align:center' width='15%'>{{ $pl['mark_health'] }}</td>
                                <td style='text-align:center' width='15%'>{{ $pl->CallPlayKe['player_name'] }}</td>
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/penilaiankesehatan/edit/' . $pl['health_assessment_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/penilaiankesehatan/hapus/' . $pl['health_assessment_id']) }}">Hapus</a>
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
