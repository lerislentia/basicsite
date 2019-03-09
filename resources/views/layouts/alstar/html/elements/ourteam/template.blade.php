 <!-- Team -->
 <section id="team" class="home-section bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div class="section-heading">
            <h2>{{ __('team.ourteam') }}</h2>
            <div class="heading-line"></div>
            <p>{{ $HeadingLine or 'HeadingLineness'}}</p>
          </div>
        </div>
      </div>
      <div class="row">
        @isset($Partners)
        @foreach($Partners as $Partner)
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          <div class="box-team wow bounceInUp" data-wow-delay="0.1s">
            <img src="{{ $Partner['LargeImage'] or 'LargeImageless' }}" alt="" class="img-circle img-responsive" />
            <h4>{{ $Partner['Name'] or 'Nameless' }}</h4>
            <p>{{ $Partner['Charge'] or 'Chargeless' }}</p>
          </div>
        </div>
        @endforeach
        @endisset        
      </div>
    </div>
  </section>