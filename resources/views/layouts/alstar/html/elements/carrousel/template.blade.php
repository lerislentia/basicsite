<section id="intro">
    <div class="intro-container">


<div id="introCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="item active">
          <div class="carousel-background"><img src="{{ $image or '' }}" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animated fadeInDown">{{ $FadeInDown or 'FadeInDown'}}</h2>
                <p class="animated fadeInUp">{{ $FadeInUp or 'FadeInUp' }}</p>
                <a href="#about" class="btn-get-started animated fadeInUp">{{ __('carrousel.readmore') }}</a>
              </div>
            </div>
          </div>
          
          <!-- Slide 2 -->
          <div class="item">
            <div class="carousel-background"><img src="{{ $imageTwo or '' }}" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animated fadeInDown">{{ $FadeInDownTwo or 'FadeInDownTwo' }}</span></h2>
                <p class="animated fadeInUp">{{ $FadeInUpTwo or 'FadeInUpTwo'}}</p>
                <a href="#about" class="btn-get-started animated fadeInUp">{{ __('carrousel.readmore') }}</a>
              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="item">
            <div class="carousel-background"><img src="{{ $imageTree or '' }}" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animated fadeInDown">{{ $FadeInDownTree or 'FadeInDownTree' }}</span></h2>
                <p class="animated fadeInUp">{{ $FadeInUpTree or 'FadeInUpTree' }}</p>
                <a href="#about" class="btn-get-started animated fadeInUp">{{ __('carrousel.readmore') }}</a>
              </div>
            </div>
          </div>

        </div>

        <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon fa fa-angle-left" aria-hidden="true"></span>
          <span class="sr-only">{{ __('carrousel.previous') }}</span>
        </a>

        <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon fa fa-angle-right" aria-hidden="true"></span>
          <span class="sr-only">{{ __('carrousel.next') }}</span>
        </a>

      </div>

      </div>
</section>