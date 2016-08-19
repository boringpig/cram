<div class="form-group">
    {{ Form::label('grade_id', '年級：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-6">
        {{ Form::select('grade_id', $grade_list, null, ['class' => 'select-grade form-control']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('classNo', '班級編號：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-9">
        {{ Form::text('classNo', null, ['class' => 'form-control', 'placeholder' => '國小代號E、國中代號J、高中代號S，依序表示年級、類別、序號，例:S101']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('name', '班級名稱：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-9">
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => '學校名稱＋班級，例：斗高數學班']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('user_id', '授課老師：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-6">
        {{ Form::select('user_id', $teacher_list, null, ['class' => 'select-teacher form-control']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('description', '班級描述：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-9">
        {{ Form::textarea('description', null, ['class' => 'form-control', 'size' => '30x5', 'placeholder' => '描述班級學習目標、主要學生群']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('times', '上課時間：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-9">
        {{ Form::select('times[]', $time_list, null, ['class' => 'select-time form-control', "multiple"]) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('published_date', '開課日期：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-9">
        {{ Form::input('date', 'published_date', $lesson->published_date, ['class' => 'form-control']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    <div class="col-sm-12">
        <div class="text-center">
            {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary btn-lg']) }}
        </div>
    </div>
</div>