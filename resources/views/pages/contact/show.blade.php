@extends('layouts.master')

@section('styles')
    <style type="text/css">
        .dl-horizontal > dt{
            text-align: left;
            width: 80px;
            font-size: 12pt;
        }
        .dl-horizontal > dd{
            margin-left: 0;
            font-size: 12pt;
        }
    </style>
@endsection

@section('title', "| $message->title")

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="row">
                <div class="col-sm-8">
                    <h3>主旨：{{ $message->title }}</h3>
                    <p class="lead">內容：{!! $message->content !!}</p>
                </div>
                <div class="col-sm-4">
                    <div class="well" style="margin-top: 20px">
                        <dl class="dl-horizontal">
                            <dt>詢問對象：</dt>
                            <dd>{{ $message->present()->showTeacherName }}</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>發送日期：</dt>
                            <dd>{{ $message->present()->created_type }}</dd>
                        </dl>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{ route('contact.record') }}" class="btn btn-default btn-block"><< 返回</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                @foreach($message->replies as $reply)
                    <div class="comment">
                        <div class="author-info">
                            <img src="{{ $reply->user->present()->Avatar_url }}" class="author-image">
                            <div class="author-name">
                                <h4>{{ $reply->user->name }}</h4>
                                <p class="author-time">{{ date('F nS, Y - g:iA' , strtotime($reply->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="comment-content">
                            {!! $reply->content !!}
                        </div>
                    </div>
                @endforeach
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-3" style="margin-top: 20px; margin-bottom: 70px">
                @include('partials._message')
                {!! Form::open(['route' => ['contact.replay'], 'method' => 'post', 'files' => true]) !!}
                    {{ Form::hidden('id', $message->id) }}
                    <div class="form-group">
                        <div class="col-sm-9">
                            {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => '想說的話......']) }}
                        </div>
                        <div class="col-sm-3">
                            {{ Form::submit('回覆', ['class' => 'btn btn-default btn-lg', 'style' => 'margin-top:80px']) }}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

        <iframe id="frameUpload" name="frameUpload" style="display:none"></iframe>
        <form id="formUpload" action="{{ route('contact.upload') }}" target="frameUpload" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            <input name="image" type="file" onchange="$('#formUpload').submit();this.value='';">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
    </div>
@endsection

@section('scripts')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            theme: 'modern',
            width: 560,
            height: 200,
            menubar: false,
            statusbar: false,
            plugins: 'image imagetools',
            toolbar: 'fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar_items_size: 'small',
            relative_urls: false,
            file_browser_callback: function(field_name, url, type, win) {
                // trigger file upload form
                if (type == 'image') $('#formUpload input').click();
            }
        });
    </script>
@endsection
