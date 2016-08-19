@extends('layouts.master')

@section('title', '| 登入')

@section('styles')
    <link rel="stylesheet" href="{{ asset('src/css/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-5 col-md-offset-4 ">
            <div class="text-center">
                <h2>會員登入</h2>
            </div>
            <br>
            @include('partials._message')
            {!! Form::open(['method' => 'post', 'role' => 'form']) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => '請輸入Email']) }}
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '請輸入密碼']) }}
                </div>
                <div class="checkbox">
                    <label><input type="checkbox"> 記住我</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary btn-block">登入</button>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ url('password/reset') }}">忘記密碼</a>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            <a href="{{ url('auth/register') }}">立即註冊</a>
                        </div>
                    </div>
                </div>
                <hr class="style1">
                <a href="{{ route('auth.getSocialAuth', ['facebook']) }}" class="btn btn-block btn-social btn-facebook">
                    <span class="fa fa-facebook"></span> 使用 Facebook 登入
                </a>
                <a href="{{ route('auth.getSocialAuth', ['google']) }}" class="btn btn-block btn-social btn-google">
                    <span class="fa fa-google"></span> 使用 Google 登入
                </a>
            {!! Form::close() !!}
        </div>
    </div>
@endsection