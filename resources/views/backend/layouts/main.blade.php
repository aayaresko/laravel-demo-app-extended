<!DOCTYPE html>
<!--
  ~ Copyright (c) 2016  Andrey Yaresko.
  -->
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    @yield('styles')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @yield('scripts')
</head>
<body>
    <div class="header">
        <div class="content">
            @include('backend.includes.header')
        </div>
    </div>
    <div class="wrap">
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="content">
            <div class="container-fluid">
                @include('backend.includes.footer')
            </div>
        </div>
    </div>
</body>
</html>