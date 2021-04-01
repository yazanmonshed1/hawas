{{-- Add Navbar Code Here --}}

{{-- @section('style') --}}

{{-- @endsection --}}
<div class="headerDiv">
    <div class="row rowBorder m-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6  col-10 text-right mt-2">
                    <a href="tel:@setting('social.phone2')" class="phoneDiv pl-2">
                        <span>
                            <i class="fa fa-phone-alt callIcon"></i>
                        </span>
                        <span class="numSpan pr-2">
                            @setting('social.phone1')
                        </span>
                    </a>
                    <a href="mailto:@setting('social.email')" class="emailDiv pr-2">
                        <span>
                            <i class="fas fa-envelope emailIcon"></i>
                        </span>
                        <span class="emailSpan pr-2">
                            @setting('social.email')
                        </span>
                    </a>
                </div>
                <div class="col-md-6 col-10  mb-2">
                    <div class="d-inline-block ml-3">
                        <form action="{{ route('search') }}" method="GET" class="search-container position-relative">
                            <input value="{{ request()->has('search') ? request()->get('search') : '' }}" type="text"
                                placeholder="ابحث في حواس …" class="search-menu nav-bar" name="search">
                            <button type="submit" class="search-menu-button">
                                <i class="fa fa-search search-menu-icon"></i>
                            </button>
                        </form>
                    </div>
                    <div class="d-inline-block">
                        <span class="socialMediaIcon">
                            <a target="_blank" href="@setting('social.facebook_url')">
                                <i class="fab fa-facebook-f social-icon"></i>
                            </a>
                        </span>
                        <span class="socialMediaIcon pr-2">
                            <a target="_blank" href="@setting('social.instagram_url')">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </span>
                        <span class="socialMediaIcon pr-2">
                            <a target="_blank" href="@setting('social.youtube_url')">
                                <i class="fab fa-youtube social-icon"></i>
                            </a>
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row m-0">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div>
                    <a href="/">
                        <img src="{{ asset('assets/images/hawasLogo.png') }}">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav dropdown">

                        <li class="program-menu">
                            <a href="{{ route('programs.index') }}" class="program-link @yield('program')" >برامجنا</a>
                            {{-- <i class="fa fa-chevron-down d-none d-lg-block" style="font-size: 10px"></i> --}}
                        </li>
                        <li class="dropdown-toggle menu-item-action pt-2" id="dropdownMenu1" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-angle-down down-arrow-icon menu-arrow @yield('program')"></i>
                        </li>
                        <ul class="dropdown-menu multi-level" id="programs-menu" role="menu"
                            aria-labelledby="dropdownMenu">
                            <li class="dropdown-item menu-item-action"><a class="program-link"
                                    href="{{ route('library', ['text']) }}">مكتبة الحواس</a></li>
                            <li class="dropdown-submenu menu-item-action">
                                <a class="dropdown-item" tabindex="-1" href="{{ route('plays.index') }}">مسرحيات
                                    الحواس
                                    <i class="fas fa-angle-down arrow-plays-multi menu-arrow"></i>
                                </a>

                                <ul class="dropdown-menu">
                                    @foreach ($plays as $play)
                                        <li class="dropdown-item">
                                            <a tabindex="-1" class="menu-item-action sub-link"
                                                href="{{ route('plays.show', [$play->slug]) }}">{{ $play->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown-submenu menu-item-action">
                                <a class="dropdown-item" tabindex="-1" href="{{ route('films.index') }}">أفلام
                                    الحواس
                                    <i class="fas fa-angle-down arrow-films-multi menu-arrow"></i>
                                </a>

                                <ul class="dropdown-menu">
                                    @foreach ($films as $film)
                                        <li class="dropdown-item menu-item-action">
                                            <a tabindex="-1" class="menu-item-action sub-link"
                                                href="{{ route('films.show', [$film->slug]) }}">{{ $film->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            @foreach ($programs as $program)
                                <li class="dropdown-item menu-item-action"><a class="program-link"
                                        href="{{ route('programs.show', [$program->slug]) }}">{{ $program->name }}</a>
                                </li>
                            @endforeach
                            <li class="dropdown-item menu-item-action"><a class="program-link"
                                    href="{{ route('channel.index') }}">قناة الحواس</a></li>
                        </ul>
                        <li class="nav-item pr-md-2 ">
                            <a class="nav-link @yield('blog')" href="{{ route('blogs.index') }}">المدونة</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link @yield('channel') " href="{{ route('channel.index') }}">قناة حواس</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link @yield('about')" href="{{ route('about') }}">من نحن</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link @yield('contact') " href="{{ route('contact.index') }}">اتصل بنا</a>
                        </li>

                    </ul>
                </div>
                @guest
                    <div class="loginDiv pt-md-1 pt-4 pb-3 pb-md-0">
                        <a href="" class="loginLink ml-2" data-toggle="modal" data-target="#sure-menuModal">
                            تسجيل الدخول
                        </a>
                    </div>
                @endguest
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="mr-2">
                        @csrf
                        <a type="submit" id="logout" class="loginLink ml-2 text-danger border-0">تسجيل الخروج</a>
                    </form>
                @endauth
                <div class="loginDiv pt-md-1 pt-4 pb-3 pb-md-0">
                    <a href="{{ route('library', ['text']) }}" class="libraryLink">
                        مكتبة الحواس
                    </a>
                </div>
            </nav>

        </div>
    </div>
</div>
