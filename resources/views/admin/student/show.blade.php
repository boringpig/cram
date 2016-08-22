@extends('admin.layouts.master')

@section('title', '| 班級管理')

@section('page-title', "$student->name")

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-4">
            <h4>狀態： {!! $student->present()->statusType !!} </h4>
            <br>
            <h4>畢業學校： {{ $student->graduated_school }}</h4>
            <br>
            <h4>學生手機： {{ $student->phone->student_phone }}</h4>
            <br>
            <h4>家長姓名： {{ $student->parent_name }}</h4>
            <br>
            <h4>家長手機： {{ $student->phone->parent_phone }}</h4>
            <br>
            <h4>家裡地址： {{ $student->address->home_address }}</h4>
            <br>
            <h4>目前上課班級：
                @foreach($student->lessons()->get() as $lesson)
                    {{ $lesson->name }}
                @endforeach
            </h4>
            <br>
            <h4>入班時間： {{ $student->present()->createdDate }}</h4>
            <br>
            <div class="col-sm-6">
                <div class="text-center">
                    <a href="{{ route('backend.students.index') }}" class="btn btn-default">返回</a>
                </div>
            </div>
        </div>
    </div>
@endsection
