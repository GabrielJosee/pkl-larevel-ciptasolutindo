@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jadwal Penilaian Kesehatan</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Jadwal Penilaian Kesehatan</b> <small>Jadwal Penilaian Kesehatan</small>
    </h3>
    <br />
    @if (session('msge'))
        <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ session('msge') }}
        </div>
    @endif
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('jadwalkesehatan/tambah') }}'" name="Find"
                    class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Bulan Periode</th>
                            <th style='text-align:center'>Tahun Periode</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($jk as $jk)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}</td>
                                @if ($jk['month_period'] == 1)
                                    <td style='text-align:center' width='20%'>Januari</td>
                                @elseif ($jk['month_period'] == 2)
                                    <td style='text-align:center' width='20%'>Februari</td>
                                @elseif ($jk['month_period'] == 3)
                                    <td style='text-align:center' width='20%'>Maret</td>
                                @elseif ($jk['month_period'] == 4)
                                    <td style='text-align:center' width='20%'>April</td>
                                @elseif ($jk['month_period'] == 5)
                                    <td style='text-align:center' width='20%'>Mei</td>
                                @elseif ($jk['month_period'] == 6)
                                    <td style='text-align:center' width='20%'>Juni</td>
                                @elseif ($jk['month_period'] == 7)
                                    <td style='text-align:center' width='20%'>Juli</td>
                                @elseif ($jk['month_period'] == 8)
                                    <td style='text-align:center' width='20%'>Agustus</td>
                                @elseif ($jk['month_period'] == 9)
                                    <td style='text-align:center' width='20%'>September</td>
                                @elseif ($jk['month_period'] == 10)
                                    <td style='text-align:center' width='20%'>Oktober</td>
                                @elseif ($jk['month_period'] == 11)
                                    <td style='text-align:center' width='20%'>November</td>
                                @elseif ($jk['month_period'] == 12)
                                    <td style='text-align:center' width='20%'>Desember</td>
                                @endif

                                @if ($jk['year_period'] == 1)
                                    <td style='text-align:center' width='10%'>2020</td>
                                @elseif ($jk['year_period'] == 2)
                                    <td style='text-align:center' width='10%'>2021</td>
                                @elseif ($jk['year_period'] == 3)
                                    <td style='text-align:center' width='10%'>2022</td>
                                @elseif ($jk['year_period'] == 4)
                                    <td style='text-align:center' width='10%'>2023</td>
                                @endif
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/jadwalkesehatan/edit/' . $jk['health_assessment_schedule_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/jadwalkesehatan/hapus/' . $jk['health_assessment_schedule_id']) }}">Hapus</a>
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
