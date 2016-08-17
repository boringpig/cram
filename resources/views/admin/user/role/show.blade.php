@extends('admin.layouts.master')

@section('title', '| 查看角色')

@section('page-title', " $role->name")

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-3">
            <h4>角色描述： {{ $role->description }}</h4>
            <br>
            <h4>角色權限：
                @foreach($role->permissions()->get() as $permission)
                    <span class="label label-primary">{{ $permission->name }}</span>
                @endforeach
            </h4>
            <br>
            <div class="col-sm-8">
                <div class="text-center">
                    <a href="{{ route('backend.roles.index') }}" class="btn btn-default">返回</a>
                </div>
            </div>
        </div>
    </div>
@endsection
