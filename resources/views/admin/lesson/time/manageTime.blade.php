@extends('admin.layouts.master')

@section('title', '| 班級管理')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/src/css/bootstrap-datetimepicker.css') }}">
@endsection

@section('page-title', '上課時間總覽')

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-offset-1">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="20%">日期(天)</th>
                        <th width="25%">開始時間</th>
                        <th width="25%">結束時間</th>
                        <th width="25%">動作</th>
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
                <h2>新增時間</h2>
                <form id="create-time" action="{{ route('backend.times.store') }}">
                    <div class="form-group">
                        <select name="day" id="day" class="select-day form-control" >
                            <option></option>
                            <option value="星期一">星期一</option>
                            <option value="星期二">星期二</option>
                            <option value="星期三">星期三</option>
                            <option value="星期四">星期四</option>
                            <option value="星期五">星期五</option>
                            <option value="星期六">星期六</option>
                            <option value="星期日">星期日</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type='text' class="form-control" name="start_time" id='start_time' placeholder="請選擇上課時間">
                    </div>
                    <div class="form-group">
                        <input type='text' class="form-control" name="end_time" id='end_time' placeholder="請選擇下課時間">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control">新增</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Grade Modal -->
    <div class="modal fade" id="edit-time-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">修改時間</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-time" action="#">
                        <div class="form-group">
                            <select name="day" id="day" class="select-day form-control" >
                                <option></option>
                                <option value='星期一'>星期一</option>
                                <option value='星期二'>星期二</option>
                                <option value='星期三'>星期三</option>
                                <option value='星期四'>星期四</option>
                                <option value='星期五'>星期五</option>
                                <option value='星期六'>星期六</option>
                                <option value='星期日'>星期日</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type='text' class="form-control" name="start_time" id='start_time' placeholder="請選擇上課時間">
                        </div>
                        <div class="form-group">
                            <input type='text' class="form-control" name="end_time" id='end_time' placeholder="請選擇下課時間">
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
    <script src="{{ asset('admin/src/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/src/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript">
        var url = "{{ route('backend.times.index') }}";
        $('.select-day').select2({
            minimumResultsForSearch: Infinity,
            placeholder: '請選擇日期(天)'
        });
        $('#start_time, #end_time').datetimepicker({
            format: 'LT'
        });
    </script>
    <script src="{{ asset('js/time.js') }}"></script>
@endsection