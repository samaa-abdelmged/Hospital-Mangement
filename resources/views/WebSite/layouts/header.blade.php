<div class="nav-outer clearfix">
    <!--Mobile Navigation Toggler For Mobile-->
    <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
    <nav class="main-menu navbar-expand-md navbar-light">
        <div class="navbar-header">
            <!-- Togg le Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon flaticon-menu"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
            <ul class="navigation clearfix">


                <li class="current dropdown"><a href="#">{{ trans('website/welcome.main') }}</a>
                    <ul>
                        <li><a href="{{ route('/') }}">{{ trans('website/welcome.main') }}</a></li>
                    </ul>
                </li>

                <li class="dropdown"><a href="#">{{ trans('website/welcome.doctors') }}</a>
                    <ul>
                        <li><a href="{{ route('ShowDoctors') }}">{{ trans('website/welcome.doctors') }}</a></li>

                    </ul>
                </li>

                <li class="dropdown"><a href="#">{{ trans('website/welcome.sections') }}</a>
                    <ul>
                        <li><a href="{{ route('ShowSections') }}">{{ trans('website/welcome.sections') }}</a></li>

                    </ul>
                </li>



                <li class="dropdown"><a href="#">{{ LaravelLocalization::getCurrentLocaleNative() }}</a>
                    <ul>
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li><a title="login in" href="{{ route('login') }}"><span class="fas fa-user-circle"
                            style="font-size: 40px"></span></a>
            </ul>
        </div>

    </nav>
    <!-- Main Menu End-->

    <!-- Main Menu End-->
    <div class="outer-box clearfix">
        <!-- Main Menu End-->
        <div class="nav-box">
            <div class="nav-btn nav-toggler navSidebar-button"><span class="icon flaticon-menu-1"></span></div>
        </div>

        <!-- Social Box -->
        <ul class="social-box clearfix">
            <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
            <li><a href="#"><span class="fab fa-twitter"></span></a></li>
            <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
            </li>

        </ul>

    </div>
</div>
