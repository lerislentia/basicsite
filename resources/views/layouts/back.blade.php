<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ mix('css/back.css') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ mix('js/app.js') }}"></script>
    @yield('headscripts')

    <title>{{ config('app.name', 'Laravel') }}</title>

    

</head>

<body>

<div class="container-fluid text-center"> 
<div class="row content">

    <div class="col-sm-4 col-md-2 nav text-left">
            @include('admin.partials.header')
    </div>

    
    <div class="col-sm-6 col-md-3 text-left">

    <div class="container-fluid">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        
        @yield('content')
    </div>
        
    </div>
        

    @yield('options')
          
    <script>


        function openTab(evt, key) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display     = "none";
                tabcontent[i].innerHTML    = "";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(key).style.display = "block";
            var tab         = document.getElementById(key);
            var node        = document.createElement("div");
            var new_attr    = document.createAttribute("id");
            new_attr.value  = "properties"; 
            node.setAttributeNode(new_attr); 
            tab.appendChild(node);
            evt.currentTarget.className += " active";
            LoadProperties(key);
            Loadpreview(key);
        }

        function browseServer(input){
        CKFinder.modal( {
			chooseFiles: true,
			width: 800,
			height: 600,
			onInit: function( finder ) {
				finder.on( 'files:choose', function( evt ) {
					var file        = evt.data.files.first();
					var output      = input;
                    output.value    = file.getUrl();
				} );
			}
		} );
    }

    </script>

    <link rel="stylesheet" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">

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

    <!-- no mix, only for back -->
    
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script><!-- ckfinder.js is required -->
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script><!-- ckeditor.js is required -->
    <script src="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script><!-- ckeditor.js is required -->
    
    


   

        @yield('scripts')

        </div>
</div>


</body>

</html>
