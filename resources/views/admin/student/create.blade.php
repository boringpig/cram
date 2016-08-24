@extends('admin.layouts.master')

@section('title', '| 學生管理')

@section('styles')
    <style type="text/css">
        .horizontal > .form-group > label{
            width : 17%;
            margin-top: 3px;
            font-size: 13pt;
        }
    </style>
@endsection

@section('page-title', '新增學生')

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-3">
            @include('admin.partials._message')
            {!! Form::model($lesson = new App\Models\Lesson, ['route' => ['backend.students.store'], 'method' => 'post' , 'class' => 'horizontal']) !!}
                @include('admin.student.partials._form', ['submitButtonText' => '建立'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/src/js/tw-city-selector.js') }}"></script>
    <script type="text/javascript">
        $(".select-status, .status-lesson").select2();
        $("#county, #district").select2({
            theme: "classic"
        });
        $(function() {
            $('form').tw_citySelector('select[name="county"]', 'select[name="district"]');
        });
    </script>
@endsection