@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content')
    <script src="https://kit.fontawesome.com/86727a2744.js" crossorigin="anonymous"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            let currentUser = "{{ auth()->user()->full_name }}";
            let message = "";

            @foreach ($jadwal as $latihan)
                @if ($latihan->user_id === auth()->user()->id)
                    <?php
                    
                    $training_day = $latihan['training_day'];
                    
                    $nama_hari = '';
                    switch ($training_day) {
                        case 1:
                            $nama_hari = 'Senin';
                            break;
                        case 2:
                            $nama_hari = 'Selasa';
                            break;
                        case 3:
                            $nama_hari = 'Rabu';
                            break;
                        case 4:
                            $nama_hari = 'Kamis';
                            break;
                        case 5:
                            $nama_hari = 'Jumat';
                            break;
                        case 6:
                            $nama_hari = 'Sabtu';
                            break;
                        case 7:
                            $nama_hari = 'Minggu';
                            break;
                        default:
                            $nama_hari = 'Hari tidak valid';
                    }
                    ?>
                    message +=

                        "{{ $nama_hari }} Latihan {{ $latihan['name_training'] }} pada jam {{ $latihan['start_time'] }} sampai jam {{ $latihan['end_time'] }} untuk tim {{ $latihan->CallTim['team_name'] }}!\n";
                @endif
            @endforeach


            if (message !== "") {
                alert(`Halo ${currentUser}!\n\n${message}`);
            }
        });
    </script>
    @php
        $bulan = [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        
        $tahun = [
            '1' => '2020',
            '2' => '2021',
            '3' => '2022',
            '4' => '2023',
        ];
    @endphp
    <div class="slider" style="">
        <div class="list">
            @foreach ($berita as $beritas)
                <div class="item">
                    @if (in_array(pathinfo($beritas->pitcure, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                        <div class="img" style="background-image: url('{{ asset('images/' . $beritas->pitcure) }}');"
                            onclick="window.location.href = '/slide/detail/{{ $beritas->slide_id }}';">
                            <div class="text">{{ $beritas->description }}</div>
                        </div>
                    @elseif (in_array(pathinfo($beritas->pitcure, PATHINFO_EXTENSION), ['mp4', 'webm']))
                        <div class="vid" style="position: relative;"
                            onclick="window.location.href = '/slide/detail/{{ $beritas->slide_id }}';">
                            <video autoplay muted>
                                <source src="{{ asset('videos/' . $beritas->pitcure) }}"
                                    type="video/{{ pathinfo($beritas->pitcure, PATHINFO_EXTENSION) }}">
                                Your browser does not support the video tag.
                            </video>
                            <div class="text-vid">{{ $beritas->description }}</div>
                        </div>
                    @else
                        Format not supported.
                    @endif
                </div>
            @endforeach
        </div>
        <div class="buttons">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
        <ul class="dots">
            <li class="active"></li>
            @for ($i = 1; $i < count($berita); $i++)
                <li></li>
            @endfor
        </ul>
    </div>

    <style>
        #scrollBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99;
            cursor: pointer;
            padding: 15px;
            border: none;
            border-radius: 44%;
            background-color: #343A40;
            color: #fff;
        }

        .slider {
            border-radius: 10px;
            width: 95vw;
            max-width: 100vw;
            height: 50vh;
            margin: auto;
            margin-top: 70px;
            position: relative;
            overflow: hidden;
        }

        .slider .list {
            position: absolute;
            width: max-content;
            height: 100%;
            left: 0;
            top: 0;
            display: flex;
            transition: 1s;
        }

        .slider .list .img {
            background-size: cover;
            background-position: center;
            width: 95vw;
            max-width: 100vw;
            height: 100%;
            object-fit: cover;
        }

        .slider .buttons {
            position: absolute;
            top: 45%;
            left: 5%;
            width: 90%;
            display: flex;
            justify-content: space-between;
        }

        .slider .buttons button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #fff5;
            color: #fff;
            border: none;
            font-family: monospace;
            font-weight: bold;
        }

        .slider .dots {
            position: absolute;
            bottom: 10px;
            left: 0;
            color: #fff;
            width: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .slider .dots li {
            list-style: none;
            width: 10px;
            height: 10px;
            background-color: #fff;
            margin: 10px;
            border-radius: 20px;
            transition: 0.5s;
        }

        .slider .dots li.active {
            width: 30px;
        }

        li {
            cursor: pointer;
        }

        .text {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px 25px 20px 25px;
            color: #ffffff;
            font-size: 24px;
        }

        .text-vid {
            position: absolute;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px 25px 20px 25px;
            color: #ffffff;
            font-size: 24px;
            width: 95vw;
        }

        .img {
            cursor: pointer;
        }

        .vid {
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50vh;
            overflow: hidden;
            position: relative;
        }

        video {
            width: 95vw;
        }

        @media screen and (max-width: 768px) {
            .slider {
                height: 400px;
            }
        }
    </style>

    <script>
        let slider = document.querySelector('.slider .list');
        let items = document.querySelectorAll('.slider .list .item');
        let next = document.getElementById('next');
        let prev = document.getElementById('prev');
        let dots = document.querySelectorAll('.slider .dots li');

        let lengthItems = items.length - 1;
        let active = 0;
        next.onclick = function() {
            active = active + 1 <= lengthItems ? active + 1 : 0;
            reloadSlider();
        }
        prev.onclick = function() {
            active = active - 1 >= 0 ? active - 1 : lengthItems;
            reloadSlider();
        }
        let refreshInterval = setInterval(() => {
            next.click()
        }, 5000);

        function reloadSlider() {
            slider.style.left = -items[active].offsetLeft + 'px';
            let last_active_dot = document.querySelector('.slider .dots li.active');
            last_active_dot.classList.remove('active');
            dots[active].classList.add('active');

            clearInterval(refreshInterval);
            refreshInterval = setInterval(() => {
                next.click()
            }, 3000);


        }

        dots.forEach((li, key) => {
            li.addEventListener('click', () => {
                active = key;
                reloadSlider();
            })
        })
        window.onresize = function(event) {
            reloadSlider();
        };
    </script>

    <button onclick="topFunction()" id="myBtn"> <i class="fa-solid fa-arrow-up"> </i></button>

    <style>
        * {
            scroll-behavior: smooth;
        }

        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            border: none;
            outline: none;
            background-color: #5bc0de;
            color: white;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        #myBtn:hover {
            background-color: dodgerblue;
            transform: scale(1.1);
        }
    </style>

    <script>
        let mybutton = document.getElementById("myBtn");

        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        function topFunction() {
            document.documentElement.scrollTop = 0;
        }
    </script>
    <br>

    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Menu Utama
            </h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class='col-md-6'>
                    <div class="card" style="height: 280px;">
                        <div class="card-header bg-blue">
                            System
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <?php foreach($menus as $menu){
                            if($menu['id_menu']==11){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('system-user') }}'"> <i class="fa fa-angle-right"></i>
                                    User</li>
                                <?php   }
                            if($menu['id_menu']==12){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('system-user-group') }}'"> <i
                                        class="fa fa-angle-right"></i> User Group</li>
                                <?php   }
                                if($menu['id_menu']==13){
                         
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('slideshow') }}'"> <i class="fa fa-angle-right"></i>
                                    Slide Show</li>
                                <?php   }
                                }

                    ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card" style="height: 280px;">
                        <div class="card-header bg-info">
                            Club
                        </div>
                        <div class="card-body scrollable">
                            <ul class="list-group">
                                <?php foreach($menus as $menu){
                            if($menu['id_menu']==22){
                        ?>
                                <li class="list-group-item main-menu-item" onClick="location.href='{{ route('player') }}'">
                                    <i class="fa fa-angle-right"></i> Player
                                </li>
                                <?php      }
                            if($menu['id_menu']==23){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('timbasket') }}'"> <i class="fa fa-angle-right"></i>
                                    Tim Basket</li>
                                <?php   }
                            if($menu['id_menu']==24){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('training') }}'"> <i
                                        class="fa fa-angle-right"></i>Tempat Latihan</li>
                                <?php   }
                            if($menu['id_menu']==25){
                        ?>
                                <li class="list-group-item main-menu-item" onClick="location.href='{{ route('jadwal') }}'">
                                    <i class="fa fa-angle-right"></i>Jadwal Latihan
                                </li>
                                <?php   }
                            } 
                        ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class='col-md-6'>
                    <div class="card" style="height: 280px;">
                        <div class="card-header bg-info">
                            Training
                        </div>
                        <div class="card-body scrollable">
                            <ul class="list-group">
                                <?php foreach($menus as $menu){
                        if($menu['id_menu']==31){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('training') }}'">
                                    <i class="fa fa-angle-right"></i> Tempat Latihan
                                </li>
                                <?php   }
                        if($menu['id_menu']==32){
                    ?>
                                <li class="list-group-item main-menu-item" onClick="location.href='{{ route('jadwal') }}'">
                                    <i class="fa fa-angle-right"></i> Jadwal Latihan
                                </li>
                                <?php   }
                        if($menu['id_menu']==33){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('kategorikesehatan') }}'">
                                    <i class="fa fa-angle-right"></i> Kategori Penilaian Kesehatan
                                </li>
                                <?php   }
                         if($menu['id_menu']==34){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('jadwalkesehatan') }}'">
                                    <i class="fa fa-angle-right"></i> Jadwal Penilaian Kesehatan
                                </li>
                                <?php   }
                         if($menu['id_menu']==35){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('kegiatan') }}'">
                                    <i class="fa fa-angle-right"></i> Kegiatan Jadwal Latihan
                                </li>
                                <?php   }
                         if($menu['id_menu']==36){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('penilaiankesehatan') }}'">
                                    <i class="fa fa-angle-right"></i> Penilaian Kesehatan
                                </li>
                                <?php   }
                            }
                    ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card" style="height: 280px;">
                        <div class="card-header bg-blue">
                            Attendance
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <?php foreach($menus as $menu){
                            if($menu['id_menu']==51){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('absensi') }}'"> <i class="fa fa-angle-right"></i>
                                    Absensi</li>
                                <?php   }
                            if($menu['id_menu']==52){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('laporan-absensi-hadir') }}'"> <i
                                        class="fa fa-angle-right"></i>
                                    Laporan Absensi</li>
                                <?php   }
                        } 
                    ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>

        <label for="">Pilih Penilaian Kesehatan Schedule ID</label>
        <select id="scheduleFilter">
            <option value="" selected hidden></option>
            @foreach ($jadwal_penilaian_kesehatan as $jpk)
                <option value="{{ $jpk['health_assessment_schedule_id'] }}">{{ $bulan[$jpk['month_period']] }}
                    {{ $tahun[$jpk['year_period']] }}
                </option>
            @endforeach
        </select>

        <div id="container" style="width:100%; height:400px;"></div>
        <script>

            document.addEventListener('DOMContentLoaded', function() {
                var penilaian_kesehatan = <?php echo json_encode($penilaian_kesehatan); ?>;

                
                var scheduleColors = {};

                
                function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }

                penilaian_kesehatan.forEach(function(item) {
                    if (!scheduleColors[item.health_assessment_schedule_id]) {
                        scheduleColors[item.health_assessment_schedule_id] = getRandomColor();
                    }
                    item.color = scheduleColors[item
                    .health_assessment_schedule_id]; 
                });

                function updateChart(selectedScheduleId) {
                    var chartData;
                    if (selectedScheduleId) {
                        var filteredChartData = penilaian_kesehatan.filter(function(item) {
                            return item.health_assessment_schedule_id == selectedScheduleId;
                        });

                        chartData = filteredChartData.map(function(item) {
                            return {
                                name: item.name_assessment,
                                personilName: item.player_name,
                                y: parseFloat(item.mark_health),
                                color: item.color 
                            };
                        });
                    } else {
                        chartData = penilaian_kesehatan.map(function(item) {
                            return {
                                name: item.name_assessment,
                                personilName: item.player_name,
                                y: parseFloat(item.mark_health),
                                color: item.color 
                            };
                        });
                    }
                    chart = Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Diagram Penilaian Kesehatan'
                        },
                        xAxis: {
                            categories: chartData.map(function(item) {
                                return item.personilName;
                            })

                        },
                        yAxis: {
                            title: {
                                text: 'Nilai'
                            }
                        },
                        tooltip: {
                            headerFormat: '',
                            pointFormat: '<b>{point.personilName}</b><br/>' + '-{point.name}: {point.y}<br> '
                        },
                        series: [{
                            name: 'Kategori Penilaian',
                            data: chartData
                        }],
                    });
                }
                var dropdown = document.getElementById('scheduleFilter');
                dropdown.addEventListener('change', function() {
                    var selectedScheduleId = this.value;
                    updateChart(selectedScheduleId);
                });
                updateChart('');
            });
        </script>


    @stop

    @section('css')

    @stop

    @section('js')

    @stop
