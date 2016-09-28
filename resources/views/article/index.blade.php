@extends('layouts.master')

@section('title', '| 公告消息')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">文章公告</h1>
        </div>
    </div>

    @foreach($articles as $article)
        <div class="row">
            <div class="col-md-7">
                <a href="{{ route('article.show', $article->id) }}">
                    <img src="{{ $article->present()->showImageUrl }}" alt="{{ $article->title }}" class="img-responsive" style="width: 700px;height: 300px;">
                </a>
            </div>
            <div class="col-md-5">
                <h3>{{ $article->title }}</h3>
                <h4>類別：<span class="label label-default">{{ $article->category->name }}</span></h4>
                <p>{{ $article->present()->body_str }}</p>
                <a class="btn btn-primary" href="{{ route('article.show', $article->slug) }}">看更多 <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
        <hr>
        {!! $articles->links() !!}
    @endforeach
@endsection