@extends('layouts.master')

@section('title', '| 上班打卡')

@section('styles')
    <link rel="stylesheet" href="{{ asset('src/css/clock.css') }}">
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
                <h2 class="text-center">打卡歷史紀錄</h2>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>上班時間</th>
                                <th>下班時間</th>
                                <th>總時數</th>
                                <th>工作內容</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cards as $card)
                                <tr>
                                    <td>{{ $card->on_duty }}</td>
                                    <td>{{ $card->off_duty }}</td>
                                    <td>{{ $card->total_hour }}</td>
                                    <td>
                                        @foreach($card->works()->get() as $work)
                                            {{ $work->pivot->hour }}hr {{ $work->name }}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {!! $cards->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('src/js/clock.js') }}"></script>
    <script src="{{ asset('src/js/moment.min.js') }}"></script>
@endsection

