<!-- Navigation -->
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle nav</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <!-- Logo text or image -->
        <a class="navbar-brand" href="/">{{ $logo or 'Genco'}}</a>

      </div>
      <div class="navigation collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li class="current"><a href="#intro">{{ __('nav.home') }}</a></li>
          <li><a href="#about">{{ __('nav.about') }}</a></li>
          <li><a href="#services">{{ __('nav.service') }}</a></li>
          <li><a href="#portfolio">{{ __('nav.works') }}</a></li>
          <li><a href="#team">{{ __('nav.team') }}</a></li>
          <li><a href="#contact">{{ __('nav.contact') }}</a></li>
          <li>
            @foreach($locales as $locale)
            <li>
              @if(app()->getLocale() != $locale['id'])
                @php
                  $loc = 'nav.'.$locale['description'];
                  $href = 'locale/'.$locale['id'];
                @endphp
                <a href="{{$href}}">{{ __($loc) }}</a>
              @endif
              
            </li>
            @endforeach
        </li>
        </ul>
      </div>
    </div>
  </nav>