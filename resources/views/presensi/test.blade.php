<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>UAbsensi</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{asset('assets/img/nesas.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/icon/192x192')}}.png">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="manifest" href="__manifest.json">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <style>
        .webcam-capture, .webcam-capture video{
           display: inline-block;
           width: 100%!important;
           margin: auto;
           height: auto!important;
           border-radius: 20px;

         
        }
        #map { height: 180px; }
    </style>
</head>

<body style="background-color:#e9ecef;">

<div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">presensi</div>
        <div class="right"></div>
    </div>
    <div class="section full mt-2">
            <div class="row" style="margin-top: 70px;">
                <div class="col">
                    <input type="hidden" id="lokasi" name="" id="">
                   <div class="webcam-capture"></div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if ($cek > 0)
                    <button id="takeabsen" class="btn btn-danger btn-block">
                    <icon-icon name="camera-outline"></icon-icon>
                    Absen Pulang
                    </button>
                    @else
                    <button id="takeabsen" class="btn btn-primary btn-block">
                    <icon-icon name="camera-outline"></icon-icon>
                    Absen Masuk
                    </button>
                    @endif  
            </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                <div id="map"></div>
            </div>
            </div>

<div class="appBottomMenu">
<a href="/Dashboard" class="item {{ request()->is('Dashboard') ? 'active' : ''}}">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="/presensi/create" class="item active">
            <div class="col">
                <ion-icon name="calendar-outline" role="img" class="md hydrated"
                    aria-label="calendar outline"></ion-icon>
                <strong>Calendar</strong>
            </div>
        </a>
        <a href="/presensi/create" class="item">
            <div class="col">
                <div class="action-button large">
                    <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline" ></ion-icon>
                </div>
            </div>
        </a>
        <a href="#" class="item">
            <div class="col">
                <ion-icon name="document-text-outline" role="img" class="md hydrated"
                    aria-label="document text outline"></ion-icon>
                <strong>Docs</strong>
            </div>
        </a>
        <a href="javascript:;" class="item">
            <div class="col">
                <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
                <strong>Profile</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->
    <script src="{{asset('assets/js/lib/jquery-3.4.1.min.js')}}"></script>
    <!-- Bootstrap-->
    <script src="{{asset('assets/js/lib/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/bootstrap.min.js')}}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="{{asset('assets/js/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
    <!-- jQuery Circle Progress -->
    <script src="{{asset('assets/js/plugins/jquery-circle-progress/circle-progress.min.js')}}"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <!-- Base Js File -->
    <script src="assets/js/base.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script>
        Webcam.set({
        width: 640,
        height: 480,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

        Webcam.attach('.webcam-capture')
        var lokasi = document.getElementById('lokasi')
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(succesCallback, errorCallback)
        }
        function succesCallback(position){
            lokasi.value = position.coords.latitude+ "," + position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 20);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
            .bindPopup('Pastikan lokasi anda sesuai.')
            .openPopup();
            var circle = L.circle([position.coords.latitude, position.coords.longitude], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 20
        }).addTo(map);
        }
        function errorCallback(){

        }

        $("#takeabsen").click(function(e){
    Webcam.snap(function(uri){
        image = uri;
    });
    var lokasi = $("#lokasi").val();
    $.ajax({
        type: 'POST',
        url: '/presensi/store', // Perbaikan sintaks pada URL
        data: {
            _token: "{{ csrf_token() }}",
            image: image,
            lokasi: lokasi
        },
        cache: false, // Perbaikan pengejaan 'cache'
        success: function(response){ // Menggunakan 'response' bukan 'respond'
    var status = response.split("|");
    if(status[0] === "success"){ // Menggunakan operator perbandingan '==='
        Swal.fire({
            title: 'Success!',
            text: status[1],
            icon: 'success', // Menggunakan icon 'success' bukan 'succes'
        });
        setTimeout(function() {
            location.href = '/Dashboard';
        }, 5000);
    } else {
        status[0] === "Error"
        Swal.fire({
            title: 'Error!',
            text: status[1],
            icon: 'error',
        });
        setTimeout(function() {
            location.href = '/Dashboard';
        }, 5000);
    }

        }

    });
});


        

     </script>

     

    <script>
        am4core.ready(function () {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("chartdiv", am4charts.PieChart3D);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

            chart.legend = new am4charts.Legend();

            chart.data = [
                {
                    country: "Hadir",
                    litres: 501.9
                },
                {
                    country: "Sakit",
                    litres: 301.9
                },
                {
                    country: "Izin",
                    litres: 201.1
                },
                {
                    country: "Terlambat",
                    litres: 165.8
                },
            ];



            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "litres";
            series.dataFields.category = "country";
            series.alignLabels = false;
            series.labels.template.text = "{value.percent.formatNumber('#.0')}%";
            series.labels.template.radius = am4core.percent(-40);
            series.labels.template.fill = am4core.color("white");
            series.colors.list = [
                am4core.color("#1171ba"),
                am4core.color("#fca903"),
                am4core.color("#37db63"),
                am4core.color("#ba113b"),
            ];
        }); // end am4core.ready()
    </script>