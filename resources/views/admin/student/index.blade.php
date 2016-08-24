@extends('admin.layouts.master')

@section('title', '| 學生管理')

@section('page-title', '學生總覽')

@section('content')
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="10%">狀態</th>
                            <th width="10%">姓名</th>
                            <th width="15%">手機</th>
                            <th width="30%">上課班級</th>
                            <th width="15%">入班時間</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{!! $student->present()->statusType !!}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->phone->student_phone }}</td>
                                <td>
                                    @foreach($student->lessons()->get() as $lesson)
                                        {{$lesson->grade->name}} {{ $lesson->name }}
                                    @endforeach
                                </td>
                                <td>{{ $student->present()->createdDate }}</td>
                                <td>
                                    <a href="{{ route('backend.students.show', $student->id) }}" class="btn btn-warning"><i class="fa fa-eye fa-lg"></i></a>
                                    <a href="{{ route('backend.students.edit', $student->id) }}" class="btn btn-info"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                    <a class="remove-student btn btn-danger" data-id="{{ $student->id }}"><i class="fa fa-trash fa-lg"></i></a>
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
        var url = "{{ route('backend.students.index') }}";
    </script>
    <script src="{{ asset('js/student.js') }}"></script>
@endsection