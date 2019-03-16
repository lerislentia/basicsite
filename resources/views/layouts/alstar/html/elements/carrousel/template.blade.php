<section id="intro">
    <div class="intro-container">


<div id="introCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <div class="carousel-inner" role="listbox">

        @isset($Slides)
        @foreach($Slides as $key => $Slide)
            <!-- Slide 1 -->
            @if($key == 1)
            <div class="item active">
            @else
            <div class="item">
            @endif
            
            <div class="carousel-background"><img src="{{ $Slide['LargeImage'] or 'LargeImageless' }}" alt=""></div>
              <div class="carousel-container">
                <div class="carousel-content">
                  <h2 class="animated fadeInDown">{{ $Slide['FadeInDown'] or 'FadeInDownless'}}</h2>
                  <p class="animated fadeInUp">{{ $Slide['FadeInUp'] or 'FadeInUpless' }}</p>
                  <a href="#about" class="btn-get-started animated fadeInUp">{{ __('carrousel.readmore') }}</a>
                </div>
              </div>
            </div>
          @endforeach
        @endisset 

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