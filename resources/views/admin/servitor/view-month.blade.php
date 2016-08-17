@extends('admin.layouts.master')

@section('title', '| 工讀生管理')

@section('page-title', '月時數報表')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            {!! Form::open(['route' => ['servitor-clock.month'], 'id' => 'search-month-form' ]) !!}
                <div class="input-group">
                    <select class="select-month form-control" style="font-size: 13pt">
                        <option value="1">1月份</option>
                        <option value="2">2月份</option>
                        <option value="3">3月份</option>
                        <option value="4">4月份</option>
                        <option value="5">5月份</option>
                        <option value="6">6月份</option>
                        <option value="7">7月份</option>
                        <option value="8">8月份</option>
                        <option value="9">9月份</option>
                        <option value="10">10月份</option>
                        <option value="11">11月份</option>
                        <option value="12">12月份</option>
                    </select>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search fa-lg"></i></button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <hr>
    <div class="month-table"></div>
@endsection

@section('scripts')
    <script src="{{ asset('js/servitor.js') }}"></script>
@endsection