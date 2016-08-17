@extends('admin.layouts.master')

@section('title', '| 新增角色')

@section('styles')
    <style type="text/css">
        .horizontal > .form-group > label{
            width : 17%;
            margin-top: 6px;
            font-size: 13pt;
        }
    </style>
@endsection

@section('page-title', '新增角色')

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
            @include('admin.partials._message')
            {!! Form::model($role = new App\Models\Role, ['route' => ['backend.roles.store'], 'method' => 'post', 'class' => 'horizontal']) !!}
                @include('admin.user.role.partials._form', ['submitButtonText' => '建立'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select-multi-perm").select2();
        });
    </script>
@endsection
