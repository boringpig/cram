<!doctype html>
<html lang="en">
<head>
    @include('admin.partials._meta-data')
    @include('admin.partials._head')
    @yield('styles')
</head>
<body>

    <div class="container">
        @yield('content')
    </div>

    @include('admin.partials._footer-scripts')
    @yield('scripts')
</body>
</html>