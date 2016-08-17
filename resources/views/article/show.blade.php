@extends('layouts.master')

@section('title', "| $article->title")

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <h1 class="text-center">{{ $article->title }}</h1>
        </div>
        <div class="col-sm-8 col-sm-offset-2">
            <!-- Category -->
            <p>
                <span class="glyphicon glyphicon-tasks"></span> 類別: <span class="label label-default">{{ $article->category->name }}</span>
            </p>
            <!-- Author -->
            <p>
                <span class="glyphicon glyphicon-user"></span> 作者：{{ $article->user->name }}
            </p>
            <!-- Date/Time -->
            <p>
                <span class="glyphicon glyphicon-time"></span> 發布日期： {{ $article->present()->createDateType }}
            </p>
            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="http://placehold.it/900x300" alt="">
            <hr>

            <!-- Post Content -->
            <p class="lead">{{ $article->body }}</p>
            <hr>

            <p>
                <label class="glyphicon glyphicon-tags">
                    @foreach($article->tags()->get() as $tag)
                        <span class="label label-success">{{ $tag->name }}</span>
                    @endforeach
                </label>
            </p>

        </div>
    </div>
@endsection