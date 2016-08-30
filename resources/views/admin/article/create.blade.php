@extends('admin.layouts.master')

@section('title', '| 新增文章')

@section('styles')
    <style type="text/css">
        .horizontal > .form-group > label{
            width: 13%;
            margin-top: 1px;
            font-size: 13pt;
        }
    </style>

@endsection

@section('page-title','新增文章')

@section('content')
    <div class="row">
        <div class="col-sm-10 col-md-offset-2">
            @include('admin.partials._message')
            {!! Form::model($article = new App\Models\Article, ['route' => ['backend.articles.store'], 'method' => 'post' , 'class' => 'horizontal', 'files' => true]) !!}
                @include('admin.article.partials._form',  ['submitButtonText' => '建立'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            menubar: false,
            plugins: "link code table print preview textcolor colorpicker ",
            toolbar1: 'bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect fontselect fontsizeselect forecolor backcolor',
            toolbar2: '| bullist numlist outdent indent | link code table | print preview | undo redo',
            toolbar_items_size: 'small'
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select-single").select2();
            $(".select-multiple").select2();
        });
    </script>
@endsection