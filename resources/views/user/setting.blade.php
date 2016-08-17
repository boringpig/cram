@extends('layouts.master')

@section('title', '| 修改密碼')

@section('page-header')
    @include('user.partials.header')
@endsection

@section('content')
    <div class="row">
        <h2>修改密碼</h2><br>
        <div class="col-md-7 col-md-offset-1">
            @include('partials._message')
            @if(is_null($user->password))
                <div class="alert alert-info" role="alert">
                    <strong>通知訊息!</strong>用其他應用程式登入，不需變更密碼～
                </div>
            @else
            {!! Form::open(['route' => ['change.user.password'], 'method' => 'post', 'id' => 'save-password', 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {{ Form::label('current_password', '目前密碼：', ['class' => 'col-sm-3 control-label']) }}
                    <div class="col-md-9">
                        {{ Form::password('current_password', ['class' => 'form-control', 'placeholder' => '請輸入目前的密碼']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('new_password', '新密碼：', ['class' => 'col-sm-3 control-label']) }}
                    <div class="col-md-9">
                        {{ Form::password('new_password', ['class' => 'form-control', 'placeholder' => '請輸入想要更改的新密碼']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('confirm_password', '確認新密碼：', ['class' => 'col-sm-3 control-label']) }}
                    <div class="col-md-9">
                        {{ Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => '請再次輸入更改的新密碼']) }}
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="text-center">
                            {{ Form::submit('修改密碼', ['class' => 'btn btn-success']) }}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\User\ChangePasswordRequest', '#save-password') !!}
@endsection