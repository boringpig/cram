<!doctype html>
<html lang="en">
<head>
    @include('partials._meta-data')
    @include('partials._head')
    @yield('styles')
</head>
<body>
    @include('partials._nav')

    <div class="container">
        @yield('page-header')
        @yield('content')

        @include('partials._footer')
    </div>

    @include('partials._footer-scripts')
    @yield('scripts')
</body>
</html>