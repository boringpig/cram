<div class="form-group">
    {{ Form::label('title', '標題：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('title', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('start', '開始日期：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('start', null, ['class' => 'form-control', 'id' => 'start']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('end', '結束日期：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('end', null, ['class' => 'form-control', 'id' => 'end']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('background_color', '背景顏色：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('background_color', null, ['class' => 'jscolor form-control', 'data-jscolor' => '{required:false,hash:true}']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('url', '連結網址：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('url', null, ['class' => 'form-control', 'placeholder' => '例如：https://www.google.com.tw']) }}
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