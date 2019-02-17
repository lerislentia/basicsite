<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- seo -->
<meta name="description" content="Pastelería y vida sana" />
<meta name="keywords" content="alimentación consciente,  pastry chef, comida, chef, pastelería, pastelería saludable, saludable, orgánico, yoga, " />
<meta name="author" content="www.pangaeaera.com" />

<title>Rebeca Delgado</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Agregados -->
<link href="css/prettyPhoto.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<!-- CSS -->
<link href="css/style-web.css" rel="stylesheet">

<script type="text/javascript" src="engine1/jquery.js"></script>

<!-- Galeria / simplelightbox-master -->
<link href='dist/simplelightbox.min.css' rel='stylesheet' type='text/css'>

<!-- Favicons -->
<link rel="shortcut icon" href="">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->
  </head>
  <body id="bodyhome">

<section id="home">

<div class="home-pattern"></div>
<div id="main-carousel" class="carousel slide wow fadeIn" data-ride="carousel">
  <div class="carousel-inner">
        <!-- *****  Logo ***** -->
        <header id="mainmenu" class="col-xs-12 col-sm-4" style="text-align:left;">

          <div class="logo">
            <h1 style="margin-bottom:0%;">REBECA <br> DELGADO</h1>
            <h2 style="font-size:16px;margin-top:0%; margin-bottom:9%;letter-spacing:3px;"> pastry chef </h2>

            <div class="col-xs-12 redes">
            <a href="https://www.facebook.com/RebecaDelgadoBaker/">  <img src="images/fb.png" alt=""></a>
            <a href="https://www.instagram.com/rebecadelgadobaker/"> <img src="images/insta.png" alt=""> </a>
            </div>
          </div>


        <div class="separador" id="separador">

        </div>
        <div class="col-xs-12" style="padding-left:0%; margin-left:0%;">
        <ul>
          <a href="blog/main.html"><li>Blog</li></a>
          <a href="html/consultorias.html"><li>Consultorías</li></a>
          <a href="html/talleres.html"> <li>Talleres</li></a>
          <a href="html/prensa.html"><li>Prensa</li></a>
          <a href="html/sobre.html"> <li>Sobre</li></a>
          <a href="html/contacto.html"> <li>Contacto</li></a>
        </ul>
        </div>

        </header>


    <div class="item active" style="background-image: url(images/slider/banner12.jpg)"> </div>
  </div><!--/.carousel-inner-->


</div>

</section><!--/#home-->



<script src="js/modal.js"type="text/javascript">
</script>



</body>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/smoothscroll.js"></script>
	<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="js/jquery.parallax.js"></script>
	<script type="text/javascript" src="js/main.js"></script>

    <!--wow animation-->
    <script src="js/wow.min.js"></script>
    <script>new WOW().init();</script>

     <!--BANNER - AUTOPLAY -->
	 <script>
      $('.carousel').carousel({
       interval: 3000,
	   pause: "false"
      });
     </script>

    <!-- simplelightbox-master -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript" src="dist/simple-lightbox.js"></script>
    <script>
        $(function(){
            var $gallery = $('.gallery a').simpleLightbox();

            $gallery.on('show.simplelightbox', function(){
                console.log('Requested for showing');
            })
            .on('shown.simplelightbox', function(){
                console.log('Shown');
            })
            .on('close.simplelightbox', function(){
                console.log('Requested for closing');
            })
            .on('closed.simplelightbox', function(){
                console.log('Closed');
            })
            .on('change.simplelightbox', function(){
                console.log('Requested for change');
            })
            .on('next.simplelightbox', function(){
                console.log('Requested for next');
            })
            .on('prev.simplelightbox', function(){
                console.log('Requested for prev');
            })
            .on('nextImageLoaded.simplelightbox', function(){
                console.log('Next image loaded');
            })
            .on('prevImageLoaded.simplelightbox', function(){
                console.log('Prev image loaded');
            })
            .on('changed.simplelightbox', function(){
                console.log('Image changed');
            })
            .on('nextDone.simplelightbox', function(){
                console.log('Image changed to next');
            })
            .on('prevDone.simplelightbox', function(){
                console.log('Image changed to prev');
            })
            .on('error.simplelightbox', function(e){
                console.log('No image found, go to the next/prev');
                console.log(e);
            });
        });
    </script>

    <!-- Validacion Formulario -->
	<script src="form/plugins.js"></script>
	<script src="form/jquery.form.js"></script>
	<script src="form/main.js"></script>
	<script src="form/contacto.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->

  </body>
</html>
