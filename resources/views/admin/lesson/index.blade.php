@extends('admin.layouts.master')

@section('title', '| 班級管理')

@section('page-title', '班級總覽')

@section('content')
    <div class="row">
        <div class="col-sm-9 col-sm-offset-2">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="15%">年級</th>
                            <th width="20%">班級名稱</th>
                            <th width="15%">授課老師</th>
                            <th width="15%">班級人數</th>
                            <th width="15%">開課日期</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lessons as $lesson)
                            <tr>
                                <td>{{ $lesson->grade->name }}</td>
                                <td>{{ $lesson->name }}</td>
                                <td>{{ $lesson->user->name }}</td>
                                <td>{{ count($lesson->students->all()) }} 人</td>
                                <td>{{ $lesson->present()->dateFormat }}</td>
                                <td>
                                    <a href="{{ route('backend.lessons.show', $lesson->id) }}" class="btn btn-warning"><i class="fa fa-eye fa-lg"></i></a>
                                    <a href="{{ route('backend.lessons.edit', $lesson->id ) }}" class="btn btn-info"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                    <a class="remove-lesson btn btn-danger" data-id="{{ $lesson->id }}"><i class="fa fa-trash fa-lg"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {!! $lessons->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var url = "{{ route('backend.lessons.index') }}";
    </script>
    <script src="{{ asset('js/lesson.js') }}"></script>
@endsection