@extends('layouts.master')

@section('title', '| Forget my Password')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">重設密碼</div>
                @include('partials._message')
                <div class="panel-body">
                    {!! Form::open(['url' => ['password/reset'], 'method' => 'post']) !!}
                        {{ Form::hidden('token', $token) }}
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                            {{ Form::text('email', $email, ['class' => 'form-control', 'placeholder' => '請輸入Email']) }}
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '請輸入新密碼']) }}
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
                            {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => '再次輸入密碼']) }}
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="text-center">
                                {{ Form::submit('重設密碼', ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection