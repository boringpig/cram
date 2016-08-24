@extends('admin.layouts.master')

@section('title', '| 點名管理')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/src/css/bootstrap-datetimepicker.css') }}">
@endsection

@section('page-title', '年/月查詢')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            {!! Form::open(['route' => ['rollCall.date'], 'id' => 'search-date-form' ]) !!}
                <div class="input-group form-group">
                    <input type='text' class="form-control" style="font-size: 13pt" name="select-date" id='select-date' placeholder="請選擇年/月">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search fa-lg"></i></button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <hr>
    <div class="col-sm-11 col-sm-offset-1">
        <div class="rollcall-table"></div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/src/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/src/locale/zh-tw.js') }}"></script>
    <script src="{{ asset('admin/src/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript">
        $('#select-date').datetimepicker({
            locale: 'zh-tw',
            viewMode: 'months',
            format: 'YYYY/MM'
        });
    </script>
    <script src="{{ asset('js/admin-rollcall.js') }}"></script>
@endsection
