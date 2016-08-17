@extends('admin.layouts.master')

@section('title', '| 查看文章')

@section('page-title', "$article->title")

@section('styles')
    <style type="text/css">
        .dl-horizontal > dt{
            text-align: left;
            width: 80px;
        }
        .dl-horizontal > dd{
            margin-left: 0;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-1">
            <p class="lead">{{ $article->body }}</p>
            <hr>
            <div class="tags">
                @foreach($article->tags()->get() as $tag)
                    <span class="label label-success">{{ $tag->name }}</span>
                @endforeach
            </div>

        </div>
        <div class="col-sm-3">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>作者:</dt>
                    <dd>{{ $article->user->name }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>類別:</dt>
                    <dd>{{ $article->category->name }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>公告日期:</dt>
                    <dd>{{ $article->present()->createDateType }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>更新日期:</dt>
                    <dd>{{ $article->present()->updateDateType }}</dd>
                </dl>

                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('backend.articles.edit', $article->id) }}" class="btn btn-info btn-block">修改</a>
                    </div>
                    <div class="col-md-6">
                        <a class="remove-article btn btn-danger btn-block" data-id="{{ $article->id }}">刪除</a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('backend.articles.index') }}" class="btn btn-default btn-block"><< 返回</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var url = "{{ route('backend.articles.index') }}";
    </script>
    <script src="{{ asset('js/articles.js') }}"></script>
@endsection