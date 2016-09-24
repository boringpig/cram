@extends('layouts.master')

@section('title', '| 訊息紀錄')

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <h1 class="page-header">訊息紀錄</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-9 col-sm-offset-2">
            @if(count($messages) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="45%">主旨</th>
                                <th width="20%">詢問對象</th>
                                <th width="20%">發送日期</th>
                                <th width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                                <tr>
                                    <td>{{ $message->title }}</td>
                                    <td>{{ $message->present()->showTeacherName }}</td>
                                    <td>{{ $message->present()->created_type }}</td>
                                    <td><a href="{{ route('contact.show', $message->message_id) }}">詳細資料 <i class="fa fa-angle-double-right"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {!! $messages->links() !!}
                    </div>
                </div>
            @else
                <h3 class="text-center">目前無訊息紀錄</h3>
            @endif
        </div>
    </div>
@endsection