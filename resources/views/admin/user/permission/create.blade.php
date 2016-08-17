@extends('admin.layouts.master')

@section('title', '| 新增權限')

@section('styles')
    <style type="text/css">
        .horizontal > .form-group > label{
            width : 17%;
            margin-top: 6px;
            font-size: 13pt;
        }
    </style>
@endsection

@section('page-title', '新增權限內容')

@section('content')
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            @include('admin.partials._message')
            {!! Form::model($permission = new App\Models\Permission, ['route' => ['backend.permissions.store'], 'method' => 'post', 'class' => 'horizontal']) !!}
                @include('admin.user.permission.partials._form', ['submitButtonText' => '建立'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
