<header class="main-header" id="header">
            <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
              </button>

              <span class="page-title">@yield('pageTitle')</span>

              <div class="navbar-right ">

                <!-- search form -->
                <div class="search-form">
                  <!-- <form action="index.html" method="get">
                    <div class="input-group input-group-sm" id="input-group-search">
                      <input type="text" autocomplete="off" name="query" id="search-input" class="form-control" placeholder="Search..." />
                      <div class="input-group-append">
                        <button class="btn" type="button">/</button>
                      </div>
                    </div>
                  </form> -->
                  <ul class="dropdown-menu dropdown-menu-search">

                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('usersList') }}">Morbi leo risus</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('usersList') }}">Dapibus ac facilisis in</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="index.html">Porta ac consectetur ac</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="index.html">Vestibulum at eros</a>
                    </li>

                  </ul>

                </div>

                <ul class="nav navbar-nav">

                  <!-- {{App::getLocale()}}
                  <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                      @foreach($available_locales as $locale_name => $available_locale)
                          @if($available_locale === $current_locale)
                              <span class="ml-2 mr-2 text-gray-700">{{ $locale_name }}</span>
                          @else
                              <a class="ml-1 underline ml-2 mr-2" href="{{ route('language', ['locale' => $available_locale]) }}">
                                  <span>{{ $locale_name }}</span>
                              </a>
                          @endif
                      @endforeach
                  </div> -->


                  <div class="btn-group" role="group" aria-label="Basic example">
                  @foreach($available_locales as $locale_name => $available_locale)
                  @if($available_locale === $current_locale)
                      <button type="button" class="btn btn-info">
                        <i class="mdi mdi-check-circle"></i> {{ $locale_name }}
                      </button>
                          @else
                      <a class="btn btn-info" href="{{ route('language', ['locale' => $available_locale]) }}">
                        <i class="mdi mdi-check-circle-outline"></i> {{ $locale_name }}
                      </a>
                          @endif
                    
                  @endforeach
                  </div>
                            
                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                      <img src="{{ asset('theme/images/user/user-default-image.png') }}" class="user-image rounded-circle" alt="User Image" />
                      <span class="d-none d-lg-inline-block">{{Auth::user()->name}}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li>
                        <a class="dropdown-link-item" href="user-profile.html">
                          <i class="mdi mdi-account-outline"></i>
                          <span class="nav-text">{{ __("trans.My Profile")}}</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-link-item" href="user-account-settings.html">
                          <i class="mdi mdi-settings"></i>
                          <span class="nav-text">{{ __("trans.Account Setting")}}</span>
                        </a>
                      </li>
                      @auth
                      <form action="{{ route('logout') }}" id="logoutForm" method="post">
                        @csrf
                      <li class="dropdown-footer">
                        <a id="logout" class="dropdown-link-item"> <i class="mdi mdi-logout"></i>{{ __("trans.Log Out")}}</a>
                      </li>
                      </form>
                      @endauth
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
          </header>