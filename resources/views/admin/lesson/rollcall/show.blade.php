@extends('admin.layouts.master')

@section('title', '| 點名管理')

@section('styles')
    <style>
        .card {
            padding: 10px;
            border: 1px solid #e5e6e4;
            border-radius: 5px;
        }
        .horizontal > .form-group > label{
            width : 11%;
            margin-top: 6px;
            font-size: 13pt;
        }
    </style>
@endsection

@section('page-title', "$rollCall->name")

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 card">
            <h4>授課老師：{{ $rollCall->teacher }}</h4>
            <h4>上課日期：{{ \Carbon\Carbon::parse($rollCall->date)->format('Y/m/d') }}</h4>
            <h4>上課時間：{{ $rollCall->class_time }}</h4>
            <h4>班級人數：{{ count($rollCall->students()->get()) }} 人</h4>
            <hr>
            {!! Form::open(['route' => ['rollCall.update', $rollCall->id], 'method' => 'post' , 'class' => 'horizontal']) !!}
                @for($i = 0; $i < count($students); $i++)
                    <div class="form-group">
                        <input type="hidden" name="student[{{ $i }}][id]" value="{{ $students[$i]->id }}">
                        {{ Form::label('status', $students[$i]->name, ['class' => 'col-sm-2 control-label']) }}
                        <div class="col-sm-3">
                            <select name="student[{{ $i }}][status]" class="form-control">
                                <option value="0" {{ ($students[$i]->pivot->status == 0) ? 'selected' : '' }}>曠課</option>
                                <option value="1" {{ ($students[$i]->pivot->status == 1) ? 'selected' : '' }}>到班</option>
                                <option value="2" {{ ($students[$i]->pivot->status == 2) ? 'selected' : '' }}>事假</option>
                                <option value="3" {{ ($students[$i]->pivot->status == 3) ? 'selected' : '' }}>病假</option>
                            </select>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" name="student[{{ $i }}][description]" value="{{ $students[$i]->pivot->description }}" class="form-control" placeholder="備註說明">
                        </div>
                    </div>
                    <div class="clearfix"></div><br>
                @endfor

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="text-center">
                            {{ Form::submit('修改', ['class' => 'btn btn-primary btn-lg']) }}
                            <a href="{{ route('rollCall-lesson.view') }}" class="btn btn-default btn-lg" style="margin-left: 20px">返回</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    @include('sweet::alert')
@endsection