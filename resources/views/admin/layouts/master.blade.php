<!doctype html>
<html lang="en">
<head>
    @include('admin.partials._meta-data')
    @include('admin.partials._head')
    @yield('styles')
</head>
<body>
    <div id="wrapper">
        @include('admin.partials._nav')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                @include('admin.partials._page-header')
                @yield('content')
            </div>
        </div>
    </div>

    @include('admin.partials._footer-scripts')
    @yield('scripts')
</body>
</html>