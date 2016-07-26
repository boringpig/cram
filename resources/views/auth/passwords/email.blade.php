@extends('layouts.master')

@section('title', '| 忘記密碼')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">重設密碼</div>
                <div class="panel-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {!! Form::open(['url' => ['password/email'], 'method' => 'post']) !!}
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                            {{ Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => '請輸入Email']) }}
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