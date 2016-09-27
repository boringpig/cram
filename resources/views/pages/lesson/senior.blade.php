@extends('layouts.master')

@section('title', '| 招生班級')

@section('content')
    <div class="row">
        <div class="col-sm-9 col-sm-offset-2">
            <h1 class="text-center">高中職班級</h1>
            <br>
        </div>
        <div class="col-sm-9 col-sm-offset-2">
            <div class="panel-group" id="accordion">
                @foreach($lessons as $lesson)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $lesson->id }}">
                                    {{ $lesson->grade->name }} {{ $lesson->name }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse{{ $lesson->id }}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>授課老師： {{ $lesson->user->name }}</p>
                                <p>班級人數： {{ count($lesson->students) }} 人</p>
                                <p>上課時間：
                                    @foreach($lesson->times()->get() as $time)
                                        {{ $time->day }} {{ $time->start_time }} ~ {{ $time->end_time }} &nbsp;&nbsp;
                                    @endforeach
                                </p>
                                <p>開課日期： {{ \Carbon\Carbon::parse($lesson->published_date)->format('Y/m/d') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <br>
            <div class="text-center">
                <a href="{{ route('home') }}" class="btn btn-default">返回</a>
            </div>
        </div>
    </div>
@endsection