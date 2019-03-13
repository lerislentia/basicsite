<!-- Bottom widget -->
<section id="bottom-widget" class="home-section bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="contact-widget wow bounceInLeft">
            <i class="fa fa-map-marker fa-4x"></i>
            <h5>{{ __('widget.mainoffice') }}</h5>
            <p>
            {!! $Mainoffice or 'mainofficeless' !!}
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="contact-widget wow bounceInUp">
            <i class="fa fa-phone fa-4x"></i>
            <h5>{{ __('widget.call') }}</h5>
            <p>
            {!! $Call or 'calless' !!}
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="contact-widget wow bounceInRight">
            <i class="fa fa-envelope fa-4x"></i>
            <h5>{{ __('widget.emailus') }}</h5>
            <p>
            {!! $Emailus or 'emailus' !!}
            </p>
          </div>
        </div>
      </div>
      <div class="row mar-top30">
        <div class="col-md-12">
          <h5>{{ __('widget.weareinsocial') }}</h5>
          <ul class="social-network">
            <li><a href="{{ $Facebook or 'facebookless' }}">
                <span class="fa-stack fa-2x">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                </span></a>
            </li>
            <li><a href="{{ $Instagram or 'Instagramless' }}">
                <span class="fa-stack fa-2x">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                </span></a>
            </li>
            <li><a href="{{ $Twitter or 'twitterless' }}">
                <span class="fa-stack fa-2x">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                </span></a>
            </li>
            <li><a href="{{ $Pinterest or 'pinterestless' }}">
                <span class="fa-stack fa-2x">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-pinterest fa-stack-1x fa-inverse"></i>
                </span></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>