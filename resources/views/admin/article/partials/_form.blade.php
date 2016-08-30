<div class="form-group">
    {{ Form::label('category_id', '類別：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-5">
        {{ Form::select('category_id', $categories, null, ['class' => 'form-control select-single']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('title', '標題：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-9">
        {{ Form::text('title', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('slug', 'slug：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-9">
        {{ Form::text('slug', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('tags', '標籤：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-9">
        {{ Form::select('tags[]', $tag_list, null, ['class' => 'form-control select-multiple', "multiple"]) }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('article_image', '上傳圖片：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-9">
        {{ Form::file('article_image') }}
    </div>
</div>
<div class="clearfix"></div><br>
<div class="form-group">
    {{ Form::label('body', '內容：', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-9">
        {{ Form::textarea('body', null, ['class' => 'form-control' ,'size' => '30x10']) }}
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

