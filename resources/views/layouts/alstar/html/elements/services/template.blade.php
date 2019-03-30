<!-- Services -->
<section id="services" class="home-section bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div class="section-heading">
            <h2>{{ __('services.services') }}</h2>
            <div class="heading-line"></div>
            <p>{{ $HeadingLine or 'HeadingLine'}}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div id="carousel-service" class="service carousel slide">

            <!-- slides -->
            <div class="carousel-inner">
            @isset($Services)
            @foreach($Services as $key => $Service)
                
                @if($key == 1)
                <div class="item active">
                @else
                <div class="item">
                @endif
                <div class="row">
                  <div class="col-sm-12 col-md-offset-1 col-md-6">
                    <div class="wow bounceInLeft">
                      <h4>{{ $Service['BounceInLefOneTitle'] or 'BounceInLefOneTitleless' }}</h4>
                      <p>{!! $Service['BounceInLefOneParagraph'] or 'BounceInLefOneParagraphless' !!}</p>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-5">
                    <div class="screenshot wow bounceInRight">
                      <img src="{{ $Service['LargeImage'] or '' }}" class="img-responsive" alt="" />
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            @endisset

            <!-- Indicators -->
            <ol class="carousel-indicators">
              @isset($Services)
              @foreach($Services as $key => $Service)
              @if($key == 1)
              <li data-target="#carousel-service" data-slide-to="{{$key-1}}" class="active"></li>
                @else
                <li data-target="#carousel-service" data-slide-to="{{$key-1}}"></li>
                @endif
              @endforeach
              @endisset
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>