@extends('admin.layouts.master')

@section('title', '| 公告類別總覽')

@section('page-title', '公告類別總覽')

@section('content')
    <div class="row">
        <div class="col-md-5 col-sm-offset-2">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="50%">名稱</th>
                        <th width="30%">動作</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                <ul id="pagination" class="pagination"></ul>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well">
                <h2>新增類別</h2>
                <form id="create-form" action="{{ route('backend.categories.store') }}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="請輸入類別名稱">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control">新增</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Item Modal -->
    <div class="modal fade" id="edit-cat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">修改類別</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-form" action="#">
                        <div class="form-group">
                            <label class="control-label" for="name">類別名稱:</label>
                            <input type="text" name="name" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">儲存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Category\CategoryRequest', '#create-form #edit-form') !!}
    <script type="text/javascript">
        var url = "{{ route('backend.categories.index') }}";
    </script>
    <script src="{{ asset('js/categories.js') }}"></script>
@endsection