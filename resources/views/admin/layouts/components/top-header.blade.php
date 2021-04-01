<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('admin.home') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('admin/assets/images/nadsoft-logo.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('admin/assets/images/nadsoft-logo.png') }}" alt="" height="17">
                    </span>
                </a>

                <a href="{{ route('admin.home') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('admin/assets/images/nadsoft-logo.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('admin/assets/images/nadsoft-logo.png') }}" alt="" height="19">
                    </span>
                </a>
            </div>


            <!-- App Search-->
            <form class="app-search d-none d-lg-block ml-2">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form>


        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">

                <button type="button" class="btn header-item waves-effect" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img class="" src="{{ config('admin.language_flag') }}" alt="Header Language" height="30">
                </button>

                <div class="dropdown-menu dropdown-menu-right">

                    <!-- item -->
                    @foreach (config('admin.languages') as $index => $key)
                        <a href="{{ route('admin.language', $key['slug']) }}" class="dropdown-item notify-item">
                            <img src="{{ $key['flag'] }}" alt="language-flag" class="mr-1" height="21"> <span
                                class="align-middle"> {{ $key['display_name'] }}</span>
                        </a>

                    @endforeach

                </div>
            </div>


            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (auth()->user()->avatar)
                        <img class="rounded-circle header-profile-user"
                            src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Header Avatar">
                    @else
                        <img class="rounded-circle header-profile-user"
                            src="{{ asset('storage/dummy/profile-img.png') }}" alt="Header Avatar">
                    @endif
                    <span class="d-none d-xl-inline-block ml-1">{{ auth()->user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    @if (auth('teacher')->check())
                        <a class="dropdown-item" href="{{ route('admin.teacher.profile.index') }}"><i
                                class="bx bx-user font-size-16 align-middle mr-1"></i>
                            {{ __('Profile') }}</a>
                    @elseif(auth('admin')->check())
                        <a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i
                                class="bx bx-user font-size-16 align-middle mr-1"></i>
                            {{ __('Profile') }}</a>
                    @endif

                    <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i
                            class="bx bx-wrench font-size-16 align-middle mr-1"></i> {{ __('Settings') }}</a>

                    <div class="dropdown-divider"></div>
                    <form action="{{ auth('admin')->check() ? route('admin.logout') : route('teacher.logout') }}"
                        method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger" href="#"><i
                                class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>
                            {{ __('Logout') }}</button>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="bx bx-cog bx-spin"></i>
                </button>
            </div>

        </div>
    </div>
</header> <!-- ========== Left Sidebar Start ========== -->
