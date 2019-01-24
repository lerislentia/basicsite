<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ mix('css/adm.css') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('headscripts')

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    

</head>

<body>

<div class="container-fluid text-center"> 
<div class="row content">

    <div class="col-sm-2 sidenav">
            @include('admin.partials.header')
    </div>

    
    <div class="col-sm-5 text-left">
        @yield('content')
    </div>
        

    <div class="col-sm-5 sidenav">
          <br>
          <div class="container">
          <div id="preview">
            </div>
          </div>
    </div>
          


    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>

        @yield('scripts')

        </div>
</div>
        <footer class="container-fluid text-center">
        <p>Footer Text</p>
      </footer>



</body>

</html>
