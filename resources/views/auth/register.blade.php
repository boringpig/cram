@extends('layouts.master')

@section('title', '| 註冊')

@section('styles')
    <link rel="stylesheet" href="{{ asset('src/css/bootstrap-social.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-5 col-md-offset-4 ">
            <div class="text-center">
                <h2>會員註冊</h2>
            </div>
            <br>
            @include('partials._message')
            {!! Form::open(['method' => 'post', 'role' => 'form']) !!}
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => '請輸入姓名']) }}
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => '請輸入Email']) }}
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '請輸入密碼']) }}
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => '再次輸入密碼']) }}
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="form-control btn btn-primary btn-block">註冊</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection