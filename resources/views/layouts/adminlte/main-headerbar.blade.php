  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-sm-inline-block">
        <a href="{{ route('dashboard') }}" class="nav-link">{{ trans('main_translate.Home') }}</a>
      </li>

    </ul>




    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        {{-- <ul>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
            @endforeach
        </ul> --}}

        {{-- @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                       @if($properties['native'] == "English")
                        <i class="flag-icon flag-icon-gb"></i>
                      @elseif($properties['native'] == "العربية")
                        <i class="flag-icon flag-icon-sa"></i>
                      @endif
              {{ $properties['native'] }}
       </a>
@endforeach --}}


        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ LaravelLocalization::getCurrentLocale()  . " "}} <i class="fa fa-globe"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            @foreach (LaravelLocalization::getSupportedLocales() as $lang => $language)
                @if ($lang != App::getLocale())
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $lang }}" href="{{ LaravelLocalization::getLocalizedURL($lang, null, [], true) }}">
                                {{ $lang . " "}} <i class="fa fa-globe"></i>
                            </a>
                @endif
            @endforeach
            </div>
        </li>


      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>





      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <div class="main-header-profile bg-primary p-3">
            <div class="d-flex wd-100p">
                <div class="main-img-user"><img alt="" src=""
                        class=""></div>
                <div class="mr-3 my-auto">
                    <h6>{{ Auth::user()->name }}</h6><span>{{ Auth::user()->email }}</span>
                </div>
            </div>
        </div>
        <a class="dropdown-item" href="{{ route('edit_user', Auth::user()->id) }}"><i class="bx bx-user-circle"></i>{{ trans('main_translate.Profile') }}</a>
        <a class="dropdown-item" href="{{ route('edit_user', Auth::user()->id) }}"><i class="bx bx-cog"></i>{{ trans('main_translate.Edit Profile') }}</a>
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                class="bx bx-log-out"></i>{{ trans('main_translate.Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </div>
    </li>



      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> --}}
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>
  </nav>
  <!-- /.navbar -->
