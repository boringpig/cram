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
    </div>

    @yield('footer')

    @include('partials._footer-scripts')
    @yield('scripts')
</body>
</html>