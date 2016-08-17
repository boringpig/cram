@extends('admin.layouts.master')

@section('title', '| 工作內容管理')

@section('page-title', '工作內容總覽')

@section('content')
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="20%">權限名稱</th>
                        <th width="60%">名稱描述</th>
                        <th width="20%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description}}</td>
                            <td>
                                <a class="show-permission btn btn-warning" data-toggle="modal" data-target="#show-perm" data-id="{{ $permission->id }}"><i class="fa fa-eye fa-lg"></i></a>
                                <a href="{{ route('backend.permissions.edit', $permission->id) }}" class="btn btn-info"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                <a class="remove-permission btn btn-danger" data-id="{{ $permission->id }}"><i class="fa fa-trash fa-lg"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {!! $permissions->links() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="show-perm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h3 class="modal-title" id="myModalLabel"></h3>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        var url = "{{ route('backend.permissions.index') }}";
    </script>
    <script src="{{ asset('js/permissions.js') }}"></script>
@endsection
