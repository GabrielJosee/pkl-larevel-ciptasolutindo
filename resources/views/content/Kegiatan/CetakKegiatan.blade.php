<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Kegiatan Jadwal Latihan</title>
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <h1 align="center">Laporan Data Kegiatan</h1>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%; ">
            <tr>
                <th>ID</th>
                <th>Latihan</th>
                <th>Kegiatan</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Deskripsi</th>
            </tr>

            
            @foreach ($activity_id as $actd)
                <tr align="center">
                    <td> {{ $actd->activity_id }}</td>
                    <td> {{ $actd->CallJadwalLat['name_training'] }}</td>
                    <td> {{ $actd->activity_name }}</td>
                    <td> {{ $actd->activity_start }}</td>
                    <td> {{ $actd->activity_end }}</td>
                    <td> {{ $actd->description_act }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
