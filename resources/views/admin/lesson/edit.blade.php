@extends('admin.layouts.master')

@section('title', '| 班級管理')

@section('styles')
    <style type="text/css">
        .horizontal > .form-group > label{
            width: 17%;
            margin-top: 3px;
            font-size: 13pt;
        }
    </style>
@endsection

@section('page-title', "修改 $lesson->name")

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            @include('admin.partials._message')
            {!! Form::model($lesson, ['route' => ['backend.lessons.update', $lesson->id], 'method' => 'put' , 'class' => 'horizontal']) !!}
                {{ Form::hidden('id', $lesson->id) }}
                @include('admin.lesson.partials._form',  ['submitButtonText' => '儲存'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select-grade, .select-teacher").select2();
            $(".select-time").select2();
        });
    </script>
@endsection

