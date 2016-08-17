<div class="form-group">
    {{ Form::label('name', '名稱：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-8">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('display_name', '暱稱：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-8">
        {{ Form::text('display_name', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('description', '角色描述：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-8">
        {{ Form::textarea('description', null,  ['class' => 'form-control', 'size' => '30x7']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('permissions', '角色權限：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-8">
        {{ Form::select('permissions[]', $permissions, null, ['class' => 'form-control select-multi-perm', 'multiple']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    <div class="col-sm-10">
        <div class="text-center">
            {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary btn-lg']) }}
        </div>
    </div>
</div>