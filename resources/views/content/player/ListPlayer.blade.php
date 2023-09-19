@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Pemain</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Pemain</b> <small>Mengelola Pemain</small>
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
                <button onclick="location.href='{{ url('player/tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Pemain Baru</button>
                <button onclick="location.href='{{ url('/CetakPlayer') }}'" class="btn btn-sm btn-info" title="Add Data"
                    style="margin-left: 5px">Print PDF
                </button>
                <button onclick="location.href='{{ url('/cetak-player-excel') }}'" class="btn btn-sm btn-info"
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
                            <th style='text-align:center'>ID</th>
                            <th style='text-align:center'>Nama Pemain</th>
                            <th style='text-align:center'>Tempat Lahir</th>
                            <th style='text-align:center'>Tanggal Lahir</th>
                            <th style='text-align:center'>Alamat</th>
                            <th style='text-align:center'>Foto</th>
                            <th style='text-align:center'>Gender</th>
                            <th style='text-align:center'>Posisi</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($player as $play)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $play ['id_player'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $play['player_name'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $play['birth_place'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $play['date_birth'] }}</td>
                                <td style='text-align:center 'width='10%'>{{ $play['player_address']}}</td>
                                <td style='text-align:center 'width='10%'>
                                    <img src="{{ asset('images/'.$play['player_image']) }}" alt="" style="width: 60px;">
                                </td>
                                @if ($play['player_gender'] == 1)
                                    <td style='text-align:center' width='10%'>Laki - Laki</td>
                                @elseif ($play['player_gender'] == 2)
                                    <td style='text-align:center' width='10%'>Perempuan</td>
                                @endif

                                @if ($play['player_position'] == 1)
                                    <td style='text-align:center' width='10%'>Point Guard</td>
                                @elseif ($play['player_position'] == 2)
                                    <td style='text-align:center' width='10%'>Shooting Guard</td>
                                @elseif ($play['player_position'] == 3)
                                    <td style='text-align:center' width='10%'>Small Forward</td>
                                @elseif ($play['player_position'] == 4)
                                    <td style='text-align:center' width='10%'>Power Forward</td>
                                @elseif ($play['player_position'] == 5)
                                    <td style='text-align:center' width='10%'>Center</td>
                                @endif
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/player/edit/' . $play['id_player']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/player/detail/' . $play['id_player']) }}">Detail</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/player/hapus/' . $play['id_player']) }}">Hapus</a>
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