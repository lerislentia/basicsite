<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>basicsite</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    @include('layouts.front.includes.head')
    @yield('headscripts')
</head>

<body class="homepage">
<div id="page-wrapper">
        @yield('content')

        @yield('scripts')
</div>
    <!-- Scripts -->

    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/bootstrap.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/wow.min.js') }}"></script>
    <script src="{{ mix('js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ mix('js/jquery.nav.js') }}"></script>
    <script src="{{ mix('js/modernizr.custom.js') }}"></script>
    <script src="{{ mix('js/grid.js') }}"></script>  
    <script src="{{ mix('js/stellar.js') }}"></script>
    <script src="{{ mix('js/custom.js') }}"></script>

</body>

</html>