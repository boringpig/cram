@extends('layouts.master')

@section('title', '| 登入紀錄')

@section('page-header')
    @include('user.partials.header')
@endsection

@section('content')
    <div class="row">
        <h2>個人登入紀錄</h2><br>
        <div class="col-md-12">
            @if(count($activities) == 0)
                <div class="alert alert-info" role="alert">
                    <strong>通知訊息!</strong>目前沒有任何登入紀錄～
                </div>
            @else
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>狀態</th>
                        <th>事件描述</th>
                        <th>日期</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $activity)
                        <tr>
                            <td>{{ $activity->id }}</td>
                            <td>{{ $activity->log_name }}</td>
                            <td>{{ $activity->description }}</td>
                            <td>{{ $activity->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                <div class="text-center">
                    {!! $activities->links() !!}
                </div>
            @endif
        </div>
    </div>
@endsection