@extends('admin.layouts.basic')

@section('title', '| 登入')

@section('styles')
    <link rel="stylesheet" href="{{ asset('src/css/sweetalert.css') }}">
@endsection

@section('content')
    <br><br><br><br>
    <div class="row">
        <div class="col-sm-4 col-md-offset-4">
            @include('admin.partials._message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">後端管理登入</h3>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route'=> ['backend.login'], 'method' => 'post']) !!}
                        <div class="form-group">
                            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => '請輸入email']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '請輸入password']) }}
                        </div>
                        <div class="checkbox">
                            <label>
                                {{ Form::checkbox('remember') }}
                                記住我
                            </label>
                        </div>
                        <div class="form-group">
                            {{ Form::submit('登入', ['class' => 'btn btn-success btn-block']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('src/js/sweetalert.min.js') }}"></script>
    @include('sweet::alert')
    {!! $validator !!}
@endsection