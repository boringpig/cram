<div class="form-group">
    {{ Form::label('name', '名稱：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('display_name', '暱稱：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('display_name', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('description', '內容描述：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-5">
        {{ Form::textarea('description', null,  ['class' => 'form-control', 'size' => '30x7']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    <div class="col-sm-8">
        <div class="text-center">
            {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary btn-lg']) }}
        </div>
    </div>
</div>