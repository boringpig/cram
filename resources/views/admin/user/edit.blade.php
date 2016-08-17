@extends('admin.layouts.master')

@section('title', '| 修改會員資料')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/src/css/bootstrap-switch.min.css') }}">
    <style type="text/css">
        .horizontal > .form-group > label{
            width : 15%;
            margin-top: 6px;
            font-size: 13pt;
        }
    </style>
@endsection

@section('page-title', '編輯會員')

@section('content')
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            @include('admin.partials._message')
            {!! Form::model($user, ['route' => ['backend.users.update', $user->id], 'method' => 'put', 'class' => 'horizontal']) !!}
            {{ Form::hidden('id', $user->id) }}
            <div class="form-group">
                {{ Form::label('name', '姓名：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-7">
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="clearfix"></div><br>
            <div class="form-group">
                {{ Form::label('email', '信箱：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-7">
                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="clearfix"></div><br>
            <div class="form-group">
                {{ Form::label('roles', '職務角色：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-7">
                    {{ Form::select('roles[]', $roles, null, ['class' => 'form-control select-multi-role', 'multiple']) }}
                </div>
            </div>
            <div class="clearfix"></div><br>
            <div class="form-group">
                {{ Form::label('status', '狀態：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-5">
                    {{ Form::checkbox('status', 1, $user->present()->is_activity, ['data-on-text'=>'啟用','data-on-color'=>'success','data-off-text'=>'停用', 'data-off-color'=>'danger']) }}
                </div>
            </div>
            <div class="clearfix"></div><br>
            <div class="form-group">
                <div class="col-sm-8">
                    <div class="text-center">
                        {{ Form::submit('儲存', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/src/js/bootstrap-switch.min.js') }}"></script>
    <script type="text/javascript">
        $('.select-multi-role').select2().val({!! json_encode($user->roles()->getRelatedIds()) !!}).trigger('change');
        $("[name='status']").bootstrapSwitch();
    </script>
@endsection