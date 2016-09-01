@extends('admin.layouts.master')

@section('title', '| 行事曆管理')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/src/css/bootstrap-datetimepicker.css') }}">
    <style type="text/css">
        .horizontal > .form-group > label{
            width: 15%;
            margin-top: 1px;
            font-size: 13pt;
        }
    </style>
@endsection

@section('page-title', '修改事件')

@section('content')
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            {!! Form::model($event, ['route' => ['backend.calendar_events.update', $event->id], 'method' => 'put' , 'class' => 'horizontal']) !!}
                @include('admin.calendar_events.partials._form', ['submitButtonText' => '儲存'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/src/js/jscolor.min.js') }}"></script>
    <script src="{{ asset('admin/src/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/src/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('admin/src/locale/zh-tw.js') }}"></script>
    <script type="text/javascript">
        $('#start, #end').datetimepicker({
            viewMode: 'months',
            format: 'YYYY/MM/DD',
            locale: 'zh-tw'
        });
    </script>
@endsection