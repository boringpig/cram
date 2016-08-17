@extends('admin.layouts.master')

@section('title', '| 工讀生管理')

@section('page-title', '工讀生總覽')

@section('content')
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="15%">狀態</th>
                            <th width="15%">姓名</th>
                            <th width="25%">工作角色</th>
                            <th width="25%">最後一次打卡</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($servitors as $servitor)
                            <tr>
                                <td>{!! $servitor->present()->statusType() !!} </td>
                                <td>{{ $servitor->name }}</td>
                                <td>
                                    @foreach($servitor->roles()->get() as $role)
                                        {{ $role->name }}
                                    @endforeach
                                </td>
                                @if(count($servitor->clockIns()->latest()->first())> 0)
                                    @if($servitor->clockIns()->latest()->first()->off_duty != null)
                                        <td>{{ $servitor->clockIns()->latest()->first()->off_duty }}</td>
                                    @else
                                        <td>{{ $servitor->clockIns()->latest()->first()->on_duty }}</td>
                                    @endif
                                @else
                                    <td>沒有紀錄</td>
                                @endif
                                <td>
                                    <a href="{{ route('backend.servitors.show', $servitor->id) }}" class="btn btn-primary">看更多</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {!! $servitors->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection