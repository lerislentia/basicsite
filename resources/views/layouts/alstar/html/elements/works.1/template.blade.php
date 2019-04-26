<!-- Works -->
<section id="portfolio" class="home-section bg-gray">
    <div class="container">
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div class="section-heading">
            <h2>{{ __('works.works') }}</h2>
            <div class="heading-line"></div>
            <p>{{ $HeadingLine or 'HeadingLineness'}}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">

          <ul id="og-grid" class="og-grid">
          @isset($works)
          @foreach($works as $work)
            <li>
              <a href="#" 
                data-largesrc="{{ $work['LargeImage'] or 'LargeImageness' }}" 
                data-title="{{ $work['Title'] or 'Titleness'}}" 
                data-description="{!! $work['Description'] or 'Descriptionness' !!}">
                <img src="{{ $work['ThumbImage'] or 'ThumbImageness' }}" alt="" />
              </a>
            </li>
          @endforeach
          @endisset
          </ul>

        </div>
      </div>
    </div>
  </section>