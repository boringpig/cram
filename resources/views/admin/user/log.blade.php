@extends('admin.layouts.master')

@section('title', '| 會員管理')

@section('page-title', '使用記錄')

@section('content')
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            @if(count($logs) == 0)
                <div class="alert alert-info" role="alert">
                    <strong>通知訊息!</strong>目前沒有任何登入紀錄～
                </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="20%">類別</th>
                            <th width="20%">姓名</th>
                            <th width="30%">詳細內容</th>
                            <th width="15%">IP 位址</th>
                            <th width="15%">時間</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->log_name }}</td>
                                <td>{{ $log->causer['name'] }}</td>
                                <td>{{ $log->description }}</td>
                                <td>{{ $log->properties['ip'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {!! $logs->links() !!}
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection


