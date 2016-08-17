@extends('layouts.master')

@section('content')
    @include('partials._message')
    <div class="row">
        <div class="col-sm-8">
            @include('pages.partials._carousel')
        </div>
        <div class="col-sm-4">
            @include('pages.partials._calendar')
        </div>
    </div>
    <hr>
    </div>

    <div class="container">
        @include('pages.partials._enroll_class')
    </div>

    <div class="container text-center">
        @include('pages.partials._teacher_team')
    </div>
    <div class="container text-center">
        @include('pages.partials._location')
    </div>
@endsection

@section('footer')
    @include('partials._footer')
@endsection