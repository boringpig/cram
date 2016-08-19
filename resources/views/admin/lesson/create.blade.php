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

@section('page-title', '新增班級')

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            @include('admin.partials._message')
            {!! Form::model($lesson = new App\Models\Lesson, ['route' => ['backend.lessons.store'], 'method' => 'post' , 'class' => 'horizontal']) !!}
                @include('admin.lesson.partials._form',  ['submitButtonText' => '建立'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select-grade, .select-teacher").select2({placeholder: '請選擇年級'});
            $(".select-time").select2();
        });
    </script>
@endsection

