<html>

<head>
    <title>basicsite</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    @include('includes.head')
    @yield('headscripts')
</head>

<body class="homepage is-preload">
    <div id="page-wrapper">
        @yield('content')
    </div>
        @yield('scripts')

    <!-- Scripts -->

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dropotron.min.js') }}"></script>
    <script src="{{ asset('js/browser.min.js') }}"></script>
    <script src="{{ asset('js/breakpoints.min.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

</body>

</html>