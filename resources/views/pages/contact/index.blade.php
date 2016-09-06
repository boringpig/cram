@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('src/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/select2.min.css') }}">
    <style type="text/css">
        .horizontal > .form-group > label{
            width: 12.4%;
            margin-top: 3px;
            font-size: 13pt;
        }
    </style>
@endsection

@section('title', '| 聯絡我們')

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <h1 class="page-header">聯絡我們</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-10 col-sm-offset-3" style="margin-bottom: 40px">
            @include('partials._message')
            {!! Form::open(['route' => ['contact.send'], 'method' => 'post' , 'class' => 'horizontal']) !!}
            <div class="form-group">
                {{ Form::label('', '姓名：', ['class' => 'col-sm-3 control-label']) }}
                <div class="col-sm-7">
                    <p style="font-size: 14pt">{{ $user->name }} &nbsp;&nbsp;先生/小姐</p>
                </div>
            </div>
            <div class="clearfix"></div><br>
            <div class="form-group">
                {{ Form::label('email', '聯絡信箱：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-7">
                    {{ Form::text('email', $user->email, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="clearfix"></div><br>
            <div class="form-group">
                {{ Form::label('teacher', '聯絡老師：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-7">
                    {{ Form::select('teacher', $teacher_list, null, ['class' => 'form-control select-teacher']) }}
                </div>
            </div>
            <div class="clearfix"></div><br>
            <div class="form-group">
                {{ Form::label('title', '主旨：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-7">
                    {{ Form::text('title', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="clearfix"></div><br>
            <div class="form-group">
                {{ Form::label('content', '內容：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-7">
                    {{ Form::textarea('content', null, ['class' => 'form-control', 'size' => '30x8' ]) }}
                </div>
            </div>
            <div class="clearfix"></div><br>
            <div class="form-group">
                <div class="col-sm-10">
                    <div class="text-center">
                        {{ Form::submit('送出', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <iframe id="frameUpload" name="frameUpload" style="display:none"></iframe>
        <form id="formUpload" action="{{ route('contact.upload') }}" target="frameUpload" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            <input name="image" type="file" onchange="$('#formUpload').submit();this.value='';">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('src/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select-teacher").select2();
        });
    </script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            width: 560,
            height: 200,
            menubar: false,
            statusbar: false,
            plugins: 'image imagetools',
            toolbar1: 'fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar_items_size: 'small',
            relative_urls: false,
            file_browser_callback: function(field_name, url, type, win) {
                // trigger file upload form
                if (type == 'image') $('#formUpload input').click();
            }
        });
    </script>
    <script type="text/javascript" src="{{ asset('src/js/sweetalert.min.js') }}"></script>
    @include('sweet::alert')
@endsection