<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Penilaian Kesehatan</title>
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
</head>

@php
        $monthname = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        $yearnum = [
            1 => '2020',
            2 => '2021',
            3 => '2022',
            4 => '2023',
        ];
@endphp

<body>
    <div class="form-group">
        <h1 align="center">Laporan Data Penilaian Kesehatan</h1>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%; ">
            <tr>
                <th>ID</th>
                <th>Jadwal Penilaian Kesehatan</th>
                <th>Kategori Penilaian Kesehatan</th>
                <th>Nilai</th>
                <th>Pemain</th>
            </tr>

            
            @foreach ($health_assessment_id as $heas)
                <tr align="center">
                    <td> {{ $heas->health_assessment_id }}</td>
                    <td> {{ $monthname[$heas->CallJadwalKe['month_period']] }} {{ $yearnum[$heas->CallJadwalKe['year_period']] }}</td>
                    <td> {{ $heas->CallKategoriKe['name_assessment'] }}</td>
                    <td> {{ $heas->mark_health }}</td>
                    <td> {{ $heas->CallPlayKe['player_name'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>