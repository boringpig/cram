@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('src/fullcalendar/css/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('src/fullcalendar/css/fullcalendar.print.css') }}" media='print'>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA1VjFo-tEonAZmKMA7yIzqyAwdhYrowAY"></script>
    <link rel="stylesheet" href="{{ asset('src/map_icon') }}">
    <script>
        // initialize
        function initialize() {
            //經緯度位置
            var location = new google.maps.LatLng(23.703492, 120.546112);
            //地圖的屬性
            var mapProp = {
                center: location,
                zoom: 17,
                mapTypeControl:true,
                mapTypeControlOptions: {
                    style:google.maps.MapTypeControlStyle.DROPDOWN_MENU
                },
                mapTypeId: google.maps.MapTypeId.TERRAIN
            };
            //new一個地圖
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            //設立地標
            var marker=new google.maps.Marker({
                map: map,
                position:location,
                icon: 'http://cram.dev/src/map_icon/location.png',
                title: '點擊我'
            });
            // Zoom to 19 當點擊地標事件
            google.maps.event.addListener(marker,'click',function() {
                map.setZoom(19);
                map.setCenter(marker.getPosition());
            });
            //離開地標10秒之後自動回來
            google.maps.event.addListener(map,'center_changed',function() {
                window.setTimeout(function() {
                    map.panTo(marker.getPosition());
                },10000);
            });
            //設立地標的資訊
            var infowindow = new google.maps.InfoWindow({
                content:"敦品補習班" + '<br>' + "地址： 640雲林縣斗六市莊敬路利民街1號"
                        + '<br>' + "經度：23.703476, 緯度：120.546199"
            });
            infowindow.open(map,marker);
        }
        //建立地圖
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection

@section('content')
    @include('partials._message')
    <div class="row">
        <div class="col-sm-8">
            @include('pages.partials._carousel')
        </div>
        <div class="col-sm-4">
            @include('pages.partials._news')
        </div>
    </div>
    <hr>

    <div class="container">
        @include('pages.partials._enroll_class')
    </div>

    <div class="container text-center">
        @include('pages.partials._teacher_team')
    </div>

    <div class="container text-center">
        @include('pages.partials._calendar')
    </div>

    <div class="container text-center">
        <h3>所在位置</h3>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div id="googleMap" style="width:100%;height:500px;"></div>
            </div>
        </div>
        <hr>
    </div>
@endsection

@section('footer')
    @include('partials._footer')
@endsection
