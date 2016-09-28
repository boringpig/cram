@extends('layouts.master')

@section('title', '| 班級點名')

@section('styles')
    <link rel="stylesheet" href="{{ asset('src/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/sweetalert.css') }}">
    <style>
        .card {
            padding: 10px;
            border: 1px solid #e5e6e4;
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <h1 class="text-center">敦品補習班-班級點名系統</h1>
            <hr>
            {!! Form::open(['route' => ['search.lesson'], 'id' => 'search-lesson-form' ]) !!}
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="input-group">
                            <select class="select-lesson form-control">
                                <option></option>
                                @foreach($lessons as $lesson)
                                    <option value="{{ $lesson->id }}">{{ $lesson->grade->name }} {{ $lesson->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row" style="margin-top: 20px">
        <div class="col-sm-8 col-sm-offset-2 card">
            <div class="rollColl"></div>
        </div>
    </div>
    <br><br>
@endsection

@section('scripts')
    <script src="{{ asset('src/js/select2.min.js') }}"></script>
    <script src="{{ asset('src/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        var url = "{{ route('rollCall.index') }}";
        $('.select-lesson').select2({
            placeholder : '請選擇點名班級'
        });
    </script>
    <script src="{{ asset('js/rollcall.js') }}"></script>
@endsection