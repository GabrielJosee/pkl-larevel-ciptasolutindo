<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <h1 align="center">Laporan Data Tim Basket</h1>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%; ">
            <tr>
                <th>ID</th>
                <th>Nama Tim</th>
                <th>Nama Pemain</th>
            </tr>
            @foreach ($timbasket as $tim)
                <tr align="center">
                    <td> {{ $tim->id_team }}</td>
                    <td> {{ $tim->CallTeam['team_name'] }}</td>
                    <td> {{ $tim->CallPlayer['player_name']}} }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>