@extends('admin.layouts.master')

@section('title', '| 工讀生管理')

@section('page-title', "打卡記錄")

@section('content')
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="20%">上班時間</th>
                            <th width="20%">下班時間</th>
                            <th width="15%">總時數</th>
                            <th width="25%">工作內容</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($servitor_clocks as $clock)
                            <tr>
                                <td>{{ $clock->on_duty }}</td>
                                <td>{{ $clock->off_duty }}</td>
                                <td>{{ $clock->total_hour }}</td>
                                <td>
                                    @foreach($clock->works()->get() as $work)
                                        {{ $work->pivot->hour }}hr {{ $work->name }}
                                    @endforeach
                                </td>
                                <td>
                                    <a href="#" class="btn btn-info"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fa fa-trash fa-lg"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {!! $servitor_clocks->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection