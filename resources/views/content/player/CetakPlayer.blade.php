<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Customer</title>
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <h1 align="center">Laporan Data Player</h1>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%; ">
            <tr>
                <th>ID</th>
                <th>Nama Pemain</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Gender</th>
                <th>Posisi</th>
            </tr>

            
            @foreach ($id_player as $ply)
                <tr align="center">
                    <td>{{ $ply ->id_player }}</td>
                    <td> {{ $ply->player_name }}</td>
                    <td> {{ $ply->birth_place }}</td>
                    <td> {{ $ply->date_birth }}</td>
                    <td> {{ $ply->player_address }}</td>
                    <td> {{ $ply->player_image }}</td>
                    @if ($ply['player_gender'] == 1)
                        <td>Laki - Laki</td>
                    @elseif ($ply['player_gender'] == 2)
                        <td>Perempuan</td>
                    @endif
                    @if ($ply['player_position'] == 1)
                        <td>Point Guard</td>
                    @elseif ($ply['player_position'] == 2)
                        <td>Shooting Guard</td>
                    @elseif ($ply['player_position'] == 3)
                        <td>Small Forward</td>
                    @elseif ($ply['player_position'] == 4)
                        <td>Power Forward</td>
                    @elseif ($ply['player_position'] == 5)
                        <td>Center</td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
