@extends('admin.layouts.master')

@section('title', '| 會員管理')

@section('page-title', '會員總覽')

@section('content')
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="15%">會員狀態</th>
                            <th width="15%">姓名</th>
                            <th width="35%">工作角色</th>
                            <th width="15%">註冊方式</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody class="detail">
                        @foreach($users as $user)
                            <tr>
                                <td>{!! $user->present()->statusType !!}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        {{ $role->name }}
                                    @endforeach
                                </td>
                                <td>{{ $user->present()->accountType}}</td>
                                <td>
                                    <a href="{{ route('backend.users.show', $user->id) }}" class="btn btn-warning"><i class="fa fa-eye fa-lg"></i></a>
                                    <a href="{{ route('backend.users.edit', $user->id) }}" class="btn btn-info"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                    <a class="remove-user btn btn-danger" data-id="{{ $user->id }}"><i class="fa fa-trash fa-lg"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-sm-9 col-sm-offset-1">
                    <div class="text-center">
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var url = "{{ route('backend.users.index') }}";
    </script>
    <script src="{{ asset('js/users.js') }}"></script>
@endsection