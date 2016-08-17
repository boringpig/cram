@extends('admin.layouts.master')

@section('title', '| 查看會員')

@section('page-title', " $user->name ")

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-3">
            <h4>狀態：{!! $user->present()->statusType !!}</h4> <br>
            @if(count($latest_login)>0)
                <h4>最近登入時間：
                    {{ $latest_login->created_at }}
                </h4> <br>
            @endif
            <h4>工作角色：
                @foreach($user->roles()->get() as $role)
                    {{ $role->name }}
                @endforeach
            </h4> <br>
            <h4>職務權限：
                @foreach($user->roles()->get() as $role)
                    @foreach($role->permissions()->get() as $permission)
                        {{ $permission->name }}
                    @endforeach
                @endforeach
            </h4> <br><br>
            <div class="col-sm-8">
                <div class="text-center">
                    <a href="{{ route('backend.users.index') }}" class="btn btn-default btn-lg">返回</a>
                </div>
            </div>
        </div>
    </div>
@endsection