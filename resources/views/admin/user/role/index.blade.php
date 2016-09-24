@extends('admin.layouts.master')

@section('title', '| 角色管理')

@section('page-title', '角色總覽')

@section('content')
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="20%">角色名稱</th>
                        <th width="60%">角色描述</th>
                        <th width="20%"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description}}</td>
                                <td>
                                    <a href="{{ route('backend.roles.show', $role->id) }}" class="btn btn-warning"><i class="fa fa-eye fa-lg"></i></a>
                                    <a href="{{ route('backend.roles.edit', $role->id) }}" class="btn btn-info"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                    <a class="remove-role btn btn-danger" data-id="{{ $role->id }}"><i class="fa fa-trash fa-lg"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-sm-9 col-sm-offset-1">
                    <div class="text-center">
                        {!! $roles->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        var url = "{{ route('backend.roles.index') }}";
    </script>
    <script src="{{ asset('js/roles.js') }}"></script>
@endsection
