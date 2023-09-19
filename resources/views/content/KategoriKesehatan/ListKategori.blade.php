@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kategori Penilaian Kesehatan</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Kategori Penilaian Kesehatan</b> <small>Kategori Penilaian Kesehatan</small>
    </h3>
    <br />
    @if(session('msge'))
        <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{session('msge')}}
        </div>
    @endif
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('kategorikesehatan/tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Kode</th>
                            <th style='text-align:center'>Nama</th>
                            <th style='text-align:center'>Keterangan</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($kt as $kt)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}</td>
                                <td style="text-align:center" width="25%">{{ $kt['kode_assessment'] }}</td>
                                <td style='text-align:center' width='25%'>{{ $kt['name_assessment'] }}</td>
                                <td style='text-align:center' width='35%'>{{ $kt['information_assessment'] }}</td>
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/kategorikesehatan/edit/' . $kt['health_assessment_categories_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/kategorikesehatan/hapus/' . $kt['health_assessment_categories_id']) }}">Hapus</a>
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