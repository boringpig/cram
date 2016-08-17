@extends('admin.layouts.master')

@section('title', '| 文章總覽')

@section('page-title', '文章總覽')

@section('content')
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="10%">類別</th>
                            <th width="15%">標題</th>
                            <th width="40%">內容</th>
                            <th width="15%">公告日期</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->category->name }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->present()->body_str }}</td>
                                <td>{{ $article->present()->createDateType }}</td>
                                <td>
                                    <a href="{{ route('backend.articles.show', $article->id) }}" class="btn btn-warning"><i class="fa fa-eye fa-lg"></i></a>
                                    <a href="{{ route('backend.articles.edit', $article->id) }}" class="btn btn-info"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                    <a class="remove-article btn btn-danger" data-id="{{ $article->id }}"><i class="fa fa-trash fa-lg"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {!! $articles->links() !!}
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