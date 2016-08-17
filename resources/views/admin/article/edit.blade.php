@extends('admin.layouts.master')

@section('title', '| 修改文章')

@section('styles')
    <style type="text/css">
        .horizontal > .form-group > label{
            width: 10%;
            margin-top: 6px;
            font-size: 13pt;
        }
    </style>
@endsection

@section('page-title','修改文章')

@section('content')
    <div class="row">
        <div class="col-sm-10 col-md-offset-2">
            @include('admin.partials._message')
            {!! Form::model($article, ['route' => ['backend.articles.update', $article->id], 'method' => 'put' , 'class' => 'horizontal']) !!}
                {{ Form::hidden('id', $article->id) }}
                @include('admin.article.partials._form', ['submitButtonText' => '儲存'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select-single").select2();
            $(".select-multiple").select2();
        });
    </script>
@endsection