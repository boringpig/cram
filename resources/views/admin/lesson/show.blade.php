@extends('admin.layouts.master')

@section('title', '| 班級管理')

@section('page-title', "$lesson->name")

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-3">
            <h4>班級編號： {{ $lesson->classNo }}</h4>
            <br>
            <h4>年級： {{ $lesson->grade->name }}</h4>
            <br>
            <h4>班級名稱： {{ $lesson->name }}</h4>
            <br>
            <h4>授課老師： {{ $lesson->user->name }}</h4>
            <br>
            <h4>班級人數： {{ count($lesson->students->all()) }} 人</h4>
            <br>
            <h4>上課時間：
                @foreach($lesson->times()->get() as $time)
                    {{ $time->day }} {{ $time->start_time }} ~ {{ $time->end_time }} &nbsp;&nbsp;
                @endforeach
            </h4>
            <br>
            <h4>開課時間： {{ $lesson->published_date }}</h4>
            <br>
            <div class="col-sm-8">
                <div class="text-center">
                    <a href="{{ route('backend.lessons.index') }}" class="btn btn-default">返回</a>
                </div>
            </div>
        </div>
    </div>
@endsection
