<div class="form-group">
    {{ Form::label('name', '學生姓名：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-6">
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => '例：王大明']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('graduated_school', '畢業學校：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-6">
        {{ Form::text('graduated_school', null, ['class' => 'form-control', 'placeholder' => '例：國立雲林科技大學']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('student_phone', '學生手機：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-6">
        {{ Form::text('student_phone', null , ['class' => 'form-control', 'placeholder' => '例：09xxx0xx92']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('parent_name', '家長姓名：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-6">
        {{ Form::text('parent_name', null, ['class' => 'form-control', 'placeholder' => '例：王大明']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('parent_phone', '家長手機：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-6">
        {{ Form::text('parent_phone', null, ['class' => 'form-control', 'placeholder' => '例：09xxx0xx92']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('home_address', '家裡地址：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-6" style="padding: 0">
        <div class="col-sm-5">
            {{ Form::select('county', [], null, ['class' => 'form-control', 'id' => 'county']) }}
        </div>
        <div class="col-sm-7">
            {{ Form::select('district', [], null, ['class' => 'form-control', 'id' => 'district']) }}
        </div>
        <div class="clearfix"></div><br>
        <div class="col-sm-12">
            {{ Form::text('home_address', null, ['class' => 'form-control', 'placeholder' => '例：圓通南路x街xx巷xxx號']) }}
        </div>
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('status', '狀態：', ['class' => 'col-sm-2 control-label', 'style' => 'padding-right: 0']) }}
    <div class="col-sm-6">
        {{ Form::select('status', ['離班','在班','試聽'], null, ['class' => 'select-status form-control']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('lessons', '班級：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-6">
        {{ Form::select('lessons[]', $lesson_list, null, ['class' => 'status-lesson form-control', 'multiple']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    <div class="col-sm-9">
        <div class="text-center">
            {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary btn-lg']) }}
        </div>
    </div>
</div>