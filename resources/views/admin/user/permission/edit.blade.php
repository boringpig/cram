@extends('admin.layouts.master')

@section('title', '| 修改權限')

@section('styles')
    <style type="text/css">
        .horizontal > .form-group > label{
            width : 17%;
            margin-top: 6px;
            font-size: 13pt;
        }
    </style>
@endsection

@section('page-title', '修改權限內容')

@section('content')
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            @include('admin.partials._message')
            {!! Form::model($permission, ['route' => ['backend.permissions.update', $permission->id], 'method' => 'put', 'class' => 'horizontal']) !!}
                {{ Form::hidden('id', $permission->id) }}
                @include('admin.user.permission.partials._form', ['submitButtonText' => '儲存'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
