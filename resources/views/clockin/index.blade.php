@extends('layouts.master')

@section('title', '| 上班打卡')

@section('styles')
    <link rel="stylesheet" href="{{ asset('src/css/clock.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/select2.min.css') }}">
    <style>
        .card {
            padding: 10px;
            border: 1px solid #e5e6e4;
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            <div id="clock" class="light">
                <div class="display">
                    <div class="weekdays"></div>
                    <div class="ampm"></div>
                    <div class="alarm"></div>
                    <div class="digits"></div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">上班打卡中心</h3>
                </div>
                <div class="list-group">
                    <a href="{{ route('clock-in.index') }}" class="list-group-item"><i class="fa fa-clock-o"></i><span> 上下班打卡</span></a>
                    <a href="{{ route('user-clock.view') }}" class="list-group-item"><i class="fa fa-eye"></i><span>  查看月時數</span></a>
                    <a href="{{ route('user-clock.log') }}" class="list-group-item"><i class="fa fa-list"></i><span>   歷史記錄</span></a>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card">
                <h2 class="text-center">敦品補習班打卡系統</h2>
                <hr>
                <div class="clock_card"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('src/js/clock.js') }}"></script>
    <script src="{{ asset('src/js/moment.min.js') }}"></script>
    <script src="{{ asset('src/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        var id = "{{ Auth::user()->id }}";
        var url = "{{ route('clock-in.manage') }}";
        var work_url = "{{ route('work.content') }}";
    </script>
    <script src="{{ asset('js/clockIn.js') }}"></script>
@endsection

