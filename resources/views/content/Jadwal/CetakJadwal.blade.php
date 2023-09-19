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
        <h1 align="center">Laporan Data Jadwal</h1>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%; ">
            <tr>
                <th>ID</th>
                <th>Nama Latihan</th>
                <th>Tempat Latihan</th>
                <th>Hari Latihan</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Deskripsi</th>
                <th>Nama Tim</th>
            </tr>

            
            @foreach ($timetable_id as $id)
                <tr align="center">
                    <td>{{ $id ->timetable_id }}</td>
                    <td> {{ $id->name_training }}</td>
                    <td> {{ $id->CallTraining['training_ground_name'] }}</td>
                    <td> {{ $id->training_day }}</td>
                    <td> {{ $id->start_time }}</td>
                    <td> {{ $id->end_time }}</td>
                    <td> {{ $id->description }}</td>
                    <td> {{ $id->CallTim['team_name'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
