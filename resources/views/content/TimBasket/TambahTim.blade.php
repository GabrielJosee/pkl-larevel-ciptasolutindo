@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/pemindahan-gudang') }}">Daftar Tim</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Tim</li>
            </ol>
        </nav>


    @stop


    @section('content')

    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Form Tambah
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('timbasket') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>
    
    
        <form method="" action="{{ url('/timbasket/tambah/list') }}" enctype="multipart/form-data" id="formTambah">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Nama Tim<a class='red'> *</a></a>
                            <input class="form-control" type="text" name="team_name" id="team_name"
                            @if ($flash == null) value=""
                                @else
                            value="{{ $flash['team_name'] }}" @endif />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Pemain<a class='red'> *</a></a>
                            <select class="form-control" aria-label="Default select example" name="id_player"
                            id="id_player">
                            @if ($id_player == null)
                                <option value="" selected hidden>-- Pilih Pemain --</option>
                                @foreach ($Player as $ply)
                                    @if ($ply['data_state'] == 0)
                                        <option value="{{ $ply['id_player'] }}">{{ $ply['player_name'] }}</option>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($Player as $ply)
                                    @if ($ply->id_player == $flash['id_player'])
                                        <?php $selected = 'selected'; ?>
                                    @else
                                        <?php $selected = ''; ?>
                                    @endif
                                    <option value="{{ $ply->id_player }}" {{ $selected }}>
                                        {{ $ply->player_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="form-actions float-right">
                        <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                                class="fa fa-times"></i> Batal</button>
                                <button class="btn btn-success" onclick='processAddArrayTim()'><i class="fa fa-plus"></i>
                                    Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        <input type="number" value="0" id="id" name="id" hidden>
        </form>
        <div class="card border border-dark">
            <div class="card-header bg-dark clearfix">
                <h5 class="mb-0 float-left">
                    Tim Basket
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                        <thead>
                            <tr>
                                <th style='text-align:center'>No</th>
                                <th style='text-align:center'>Nama Tim</th>
                                <th style='text-align:center'>Nama Pemain</th>
                                <th style='text-align:center'>Aksi</th>
                            </tr>
                        </thead>
                        <?php $subtotal = 0; ?>
                        @if (!count($list) == 0)
                            <tbody>
                                <?php
                                $count = -1;
                                foreach ($list as $index => $value) {
                                    if (!is_null($value)) {
                                        $count = $index + 1;
                                    }
                                }
                                $no = 1; ?>
                                @for ($i = 0; $i < $count; $i++)
                                    @if (isset($list[$i]))
                                        <tr>
                                            <td style='text-align:center' width='5%'>{{ $no }}</td>
                                            <td style='text-align:center' width='45%'>{{ $list[$i]['team_name'] }}</td>
                                            <td style='text-align:center' width='45%'>{{ $list[$i]['player_name'] }}</td>
                                            <td style='text-align:center' width='5%'>
                                                <a type="button" class="btn btn-outline-danger btn-sm"
                                                    href="{{ url('/timbasket/tambah/hapus/' . $i) }}">Hapus</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endfor
                            </tbody>
                    </table>
                    <form action="/timbasket/tambah/process" id="tambah">
                        <button type="submit" class="btn btn-primary float-right mt-1"><i class="fa fa-check"></i>
                            Simpan</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <script>
            const player = document.getElementById('id_player');         
            const form = document.getElementById('formTambah');
            player.addEventListener('change', () => {
                form.submit();
            });
        
            function processAddArrayTim() {
                var team_name = document.getElementById("team_name").value;
                var id_player = document.getElementById("id_player").value;
                // var lastTeamName = document.getElementById("lastTeamName").value;
                var id = document.getElementById("id");
                id.value = 1;
                
                // if (!team_name) {
                //     team_name = lastTeamName;
                // }

                $.ajax({
                    type: "POST",
                    url: "{{ route('sessionListTim') }}",
                    data: {
                        'team_name': team_name,
                        'id_player': id_player,
                    },
                    success: function(msg) {
                        location.reload();
                    }
                });
            }
        </script>


    @stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
