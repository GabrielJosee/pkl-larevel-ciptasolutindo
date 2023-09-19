@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Slide Show</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Slide Show</b> <small>Slide Show</small>
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
                <button onclick="location.href='{{ url('slide/tambah') }}'" name="Find" class="btn btn-sm btn-info"
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
                            <th style='text-align:center'>Gambar/Video</th>
                            <th style='text-align:center'>Keterangan</th>
                            <th style='text-align:center'>Tanggal Mulai</th>
                            <th style='text-align:center'>Tanggal Berakhir</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($slide as $sl)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}</td>
                                <td style="text-align:center" width="25%">
                                    @if (pathinfo($sl['pitcure'], PATHINFO_EXTENSION) === 'jpg' || pathinfo($sl['pitcure'], PATHINFO_EXTENSION) === 'png')
                                        <img src="{{ asset('images/' . $sl['pitcure']) }}" alt="" style="width: 60px;">
                                    @elseif (pathinfo($sl['pitcure'], PATHINFO_EXTENSION) === 'mp4')
                                        <video width="60" controls>
                                            <source src="{{ asset('videos/' . $sl['pitcure']) }}" type="video/mp4">
                                            Maaf, browser Anda tidak mendukung pemutaran video.
                                        </video>
                                    @else
                                        Tipe konten tidak dikenali.
                                    @endif
                                </td>
                                <td style='text-align:center' width='10%'>{{ $sl['description'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $sl['start_date'] }}</td>
                                <td style='text-align:center 'width='10%'>{{ $sl['end_date']}}</td>
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/slide/edit/' . $sl['slide_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/slide/hapus/' . $sl['slide_id']) }}">Hapus</a>
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