@extends('layouts.master')

@section('title','| 修改個人資料')

@section('page-header')
    @include('user.partials.header')
@endsection

@section('content')
    <div class="row">
        <h2>修改個人檔案</h2><br>
        {{-- edit user form --}}
        <div class="col-md-7">
            @include('partials._message')
            {!! Form::model($user, ['route' => ['edit.user.profile', $user->id], 'method' => 'post', 'id' => 'save-user', 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {{ Form::label('name', '使用者名稱：', ['class' => 'col-sm-3 control-label']) }}
                    <div class="col-sm-9">
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email：', ['class' => 'col-sm-3 control-label']) }}
                    <div class="col-sm-9">
                        {{ Form::text('email', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('', '登入方式：', ['class' => 'col-sm-3 control-label']) }}
                    <div class="col-sm-9">
                        <p class="form-control-static">{{ $user->present()->loginType }}</p>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('', '創建日期：', ['class' => 'col-sm-3 control-label']) }}
                    <div class="col-sm-9">
                        <p class="form-control-static">{{ $user->present()->createdDate }}</p>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="text-center">
                            {{ Form::submit('儲存個人資料', ['class' => 'btn btn-success']) }}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        {{--edit user image--}}
        <div class="col-md-4 col-sm-offset-1">
            <div class="text-center">
                <img src="{{ $avatar_url }}" class="img-circle img-thumbnail" style="width: 180px; height: 180px" alt="avatar">
                <h5>上傳大頭貼</h5>
                {!! Form::open(['route' => ['user.avatar'], 'method'=> 'post', 'files' => 'true']) !!}
                    {{ Form::file('avatar' , ['style' => 'margin-left:90px']) }}
                    {{ Form::submit('送出', ['class' => 'btn btn-default', 'style' => 'margin-top:15px']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\User\EditProfileRequest', '#save-user') !!}
@endsection