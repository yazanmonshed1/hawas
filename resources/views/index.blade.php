@extends('layouts.app')






@section('style')
    {{-- Add Css File Here for this page --}}
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection


@section('body')
    {{-- Write Body Code Here --}}

    <!-- Slider Section -->
    <section>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($sliders as $index => $slider)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        @php
                            $extArr = explode('.', $slider->image);
                        @endphp
                        <section class="section_slider_background position-relative" @if (in_array(end($extArr), ['png', 'jpg', 'jpeg'])) style="background-image: url('{{ asset('storage/' . $slider->image) }}')" @endif>
                            <div class="row m-0 row-style text-center">
                                <div class="opacity_slider_div">
                                </div>
                                {{-- <div class="col-12"> --}}

                                {{-- </div> --}}
                                @if (in_array(end($extArr), ['mp4', 'avi']))
                                    <video class="position-relative slider-vid" style="border-radius: 15px" muted
                                        playsinline>
                                        <source src="{{ asset('storage/' . $slider->image) }}"
                                            type="video/{{ end($extArr) }}">
                                    </video>
                                @endif
                                <div
                                    class="col-12 text-center {{ in_array(end($extArr), ['mp4', 'avi']) ? 'position-absolute' : '' }}">
                                    <div class="sliderTitleDiv">
                                        <p class="sliderTitle">{{ $slider->title }}</p>
                                    </div>
                                    <div class="sliderTextDiv">
                                        <p class="sliderText sliderTextStyle text-center">{{ $slider->description }}</p>
                                    </div>
                                </div>

                            </div>
                        </section>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control arrow_slider_left" aria-hidden="true">
                    <img src="{{ asset('assets/images/previous.svg') }}">
                </span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next carousel_style" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control arrow_slider_right" aria-hidden="true">
                    <img src="{{ asset('assets/images/next.svg') }}">
                </span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    <!-- Login Section -->
    @guest
        <section class="loginSectionDiv">
            <div class="container pt-3">
                <form action="{{ route('login') }}" method="POST" class="row submit_form_via_ajax login loginRowDiv m-md-0">
                    @csrf
                    <div class="col-md-2 offset-md-1 divLoginBorder">
                        <p class="textLogin text-md-right text-center">تريد الدخول لمنصة حواس التعليمية؟</p>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-6 text-md-right text-center">
                                <label for="username">اسم المستخدم</label>
                                <input type="username" id="username" name="username">
                            </div>
                            <div class="col-md-6 mt-md-0 mt-2 text-md-right text-center">
                                <label for="password" class="password-label">كلمة المرور</label>
                                <input type="password" id="password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4  text-center mb-md-0 mb-3 enterDiv">
                        <button type="submit" class="btn enterButton">دخول</button>
                    </div>
                </form>
            </div>
        </section>
    @endguest

    <!-- Who are we Section -->
    <section class="section-space">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-md-right text-center">
                    <h5 class="aboutTitle">
                        من نحن
                    </h5>
                    <p class="aboutText">
                        @setting('site.about_us_text_home_page')
                    </p>
                    <a href="{{ route('about') }}" class="btn moreButton">
                        <span class="moreText">المزيد</span>
                        <span class="moreLeftArrow">
                            <i class="fas fa-long-arrow-alt-left">

                            </i></span>
                    </a>
                </div>
                <div class="col-md-6 mt-md-0 mt-4 text-center">
                    <video controls class="w-100" muted controls>
                        <source src="{{ asset('storage/' . Helper::setting('site.about_us_image_home_page')) }}"
                            class="imageAbout">
                        <img src="{{ asset('assets/images/videoplayer.png') }}" alt="">
                    </video>
                </div>
            </div>
        </div>
    </section>

    <!-- Hawas Library Section -->
    <section class="position-relative section-space overflow-hidden">
        {{-- <div class="d-md-block d-none  mt-md-5"></div> --}}
        <div class="container">
            <div class="row {{-- ml-0 row-div-space --}}">
                <div class="col-md-6 pl-md-0">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('library', ['digital']) }}" class="card bookCardStyle">
                                <div class="cardBackgroundBlueImage">
                                </div>
                                <img class="card-img-top imageInCard" src="{{ asset('assets/images/videoplayer.png') }}"
                                    alt="Card image cap">
                                <div class="card-body p-1 text-center">
                                    <p class="digitalBook">كتب رقمية</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mt-md-0 mt-3">
                            <a href="{{ route('library', ['text']) }}" class="card bookCardStyle">
                                <div class="cardBackgroundOrangeImage">

                                </div>
                                <img class="card-img-top imageBookInCard"
                                    src="{{ asset('assets/images/bookImage.png') }}" alt="Card image cap">
                                <div class="card-body p-1 text-center">
                                    <p class="paper-book">كتب ورقية</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pt-5 mt-md-5 mb-md-5 text-md-right text-center library-div">
                    <h5 class="library-title">
                        مكتبة حواس
                    </h5>
                    <p class="library-text mt-3">@setting('site.hawas_library_text_home_page')</p>
                    <div class="freak-container blue-bg"></div>
                </div>
            </div>
        </div>

    </section>

    <!-- Card Categories -->
    <section class="section-space">
        <div class="container">
            <div class="row">
                @component('common.cardCategory')
                    @slot('href') {{ route('library', ['text']) }} @endslot
                    @slot('image') dummy/p_library.png @endslot
                    @slot('text') مكتبة الحواس @endslot
                @endcomponent
                @component('common.cardCategory')
                    @slot('href') {{ route('plays.index') }} @endslot
                    @slot('image') dummy/p_play.png @endslot
                    @slot('text') مسرحيات الحواس @endslot
                @endcomponent
                @component('common.cardCategory')
                    @slot('href') {{ route('films.index') }} @endslot
                    @slot('image') dummy/p_movie.png @endslot
                    @slot('text') أفلام الحواس @endslot
                @endcomponent
                @foreach ($programs as $program)
                    @component('common.cardCategory')
                        @slot('href') {{ route('programs.show', [$program->slug]) }} @endslot
                        @slot('image') {{ $program->image }} @endslot
                        @slot('text') {{ $program->name }} @endslot
                    @endcomponent
                @endforeach
                @component('common.cardCategory')
                    @slot('href') {{ route('channel.index') }} @endslot
                    @slot('image') dummy/p_channel.png @endslot
                    @slot('text') قناة الحواس @endslot
                @endcomponent
            </div>
        </div>
    </section>

    @include('common.homepage.blogs', ['blogs' => $blogs])

    <!-- channel Section -->
    <section class="section-space position-relative">
        <div class="d-md-block d-none mt-md-5"></div>
        <div class="container">
            <div class="row {{-- ml-0 row-div-space --}}">
                <div class="col-md-6 pt-5 mt-md-5 mb-md-5 text-md-right text-center channel-div">
                    <h5 class="library-title">
                        قناة حواس
                    </h5>
                    <p class="library-text mt-3">@setting('channel.description_text_home_page')</p>
                    <div class="freak-container light-blue-bg"></div>
                </div>
                <div class="col-md-6 pr-0 pl-0">
                    <div>
                        <video class="w-100 position-relative" style="border-radius: 15px" muted controls>
                            <source src="{{ asset('storage/' . Helper::setting('channel.brief_video')) }}"
                                type="video/mp4">
                        </video>
                        {{-- <div class="video-play-image">
                            <i class="fas fa-play video-icon"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection


@section('script')
    {{-- Write Js Script Code Here --}}
    <script>
        var vid = $(".slider-vid");
        vid.each(function(idx, el) {
            console.log(el)
            el.play()
        })

    </script>
@endsection
