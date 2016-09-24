@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="centering text-center error-container">
                <div class="text-center">
                    <h2 class="without-margin">
                        <span class="text-danger">
                            <big>你沒有足夠的權限，無法進入該網頁</big>
                        </span>
                    </h2>
                    <a href="{{ route('home') }}" class="btn btn-default">回首頁</a>
                </div>
            </div>
        </div>
    </div>
@endsection
