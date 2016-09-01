@extends('admin.layouts.master')

@section('title', '| 行事曆管理')

@section('page-title', '事件總覽')

@section('content')
    <div class="row">
        <div class="col-md-11 col-sm-offset-1">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="15%">標題</th>
                            <th width="15%">開始日期</th>
                            <th width="15%">結束日期</th>
                            <th width="15%">背景顏色</th>
                            <th width="20%">網址</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->start)->format('Y/m/d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->end)->format('Y/m/d') }}</td>
                                <td>
                                    <input style="border:0;width: 100px;background-color: {{ $event->background_color }}">
                                </td>
                                <td>{{ $event->present()->url_str }}</td>
                                <td>
                                    <a href="{{ route('backend.calendar_events.edit', $event->id) }}" class="btn btn-info"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                    <a class="remove-event btn btn-danger" data-id="{{ $event->id }}"><i class="fa fa-trash fa-lg"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var url = "{{ route('backend.calendar_events.index') }}";
    </script>
    <script src="{{ asset('js/admin-calendar.js') }}"></script>
@endsection
