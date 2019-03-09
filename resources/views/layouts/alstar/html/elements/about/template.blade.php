<!-- About -->
<section id="about" class="home-section bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div class="section-heading">
            <h2>{{ __('about.aboutus') }}</h2>
            <div class="heading-line"></div>
            <p>{{ $HeadingLine or 'HeadingLine'}}</p>
          </div>
        </div>
      </div>
      <div class="row wow fadeInUp">
        <div class="col-md-6 about-img">
          <img src="{{ $image or ''}}" alt="">
        </div>

        <div class="col-md-6 content">
          <h2>{{ $MainTitle or '' }}</h2>
          <h3>{{ $SubTitle or '' }}</h3>
          <p>
            {!! $Paragraph or '' !!}
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- end About -->
