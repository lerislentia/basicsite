<html lang="{{ app()->getLocale() }}">

<head>
    <title>{{ config('app.default.GENERATE_BASEURL', 'Laravel') }} | ({{ strtoupper(app()->getLocale()) }})</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />

    <script src="{{ URL::asset('js/jquery.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    @yield('headscripts')
</head>

<body>

    <div class="main">
        @yield('content')
    </div>

    <!-- Scripts -->

    
    <script src="{{ URL::asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('js/wow.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.nav.js') }}"></script>
    <script src="{{ URL::asset('js/modernizr.custom.js') }}"></script>
    <script src="{{ URL::asset('js/grid.js') }}"></script>  
    <script src="{{ URL::asset('js/stellar.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.fancybox.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.fancybox.pack.js') }}"></script>
    <script src="{{ URL::asset('js/custom.js') }}"></script>

        @yield('scripts')

    <!-- end Scripts -->

    
    
    

</body>

</html>