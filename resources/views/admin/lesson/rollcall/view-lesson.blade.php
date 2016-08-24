@extends('admin.layouts.master')

@section('title', '| 點名管理')

@section('styles')
    <link rel="stylesheet" href="{{ asset('src/css/select2.css') }}">
@endsection

@section('page-title', '班級查詢')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            {!! Form::open(['route' => ['rollCall.lesson'], 'id' => 'search-lesson-form' ]) !!}
                <div class="input-group form-group">
                    <select name="select-lesson" id="select-lesson" class="form-control">
                        <option></option>
                        @foreach($lesson_list as $lesson)
                            <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                        @endforeach
                    </select>
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
    <script src="{{ asset('js/admin-rollcall.js') }}"></script>
    <script type="text/javascript">
        $('select[name="select-lesson"]').select2({
            placeholder: '請選擇查詢的班級'
        });
    </script>
@endsection
