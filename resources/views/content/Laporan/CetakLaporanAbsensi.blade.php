<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Laporan Absensi</title>
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <h1 align="center">Laporan Absensi</h1>
        <h4 align="center">Periode {{$start_date}} s/d {{$end_date}}</h4>
        <table class="static" rules="all" border="1px" style="width: 95%; ">
            <tr align="center">
                <th width="10%"><b>No</b></th>
                <th width="20%"><b>Nama Pemain</b></th>
                <th width="15%"><b>Jadwal Latihan</b></th>
                <th width="15%"><b>Jam Mulai</b></th>
                <th width="15%"><b>Jam Selesai</b></th>
                <th width="30%"><b>Jam Absen</b></th>
            </tr>
                <?php $no = 1; ?>
                @foreach ($absen as $si)
                    <tr>
                        <td width="10%" align="center">{{ $no }}</td>
                        <td width="20%" align="center">{{$si->CallPlayer['player_name'] }}</td>
                        <td width="15%" align="center">{{$si->CallJadwal['name_training']}}</td>
                        <td width="15%" align="center">{{$si->CallJadwal['start_time']}}</td>
                        <td width="15%" align="center">{{$si->CallJadwal['end_time']}}</td>
                        <td width="30%" align="center">{{$si['attendance_datetime']}}</td>
                    </tr>
                    <?php $no++; ?>
                @endforeach
        </table>
    </div>
</body>

</html>
