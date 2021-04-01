@extends('layouts.app')






@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/about.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick-theme.min.css') }}">

    <style>
        .js .slider-single>div:nth-child(1n+2) {
            display: none
        }

        .js .slider-single.slick-initialized>div:nth-child(1n+2) {
            display: block
        }


        .slider-nav {
            margin-top: 30px;
        }

        .slider-nav .slick-slide {
            cursor: pointer;
        }

        .slider-nav .slick-slide {
            height: 100% !important;
            padding: 5px;
        }

        .slick-dots li.slick-active button:before {
            opacity: .75;
            color: #52CFCC;
            font-family: "Font Awesome 5 Free", sans-serif;
            font-weight: 900;
            content: "\f111";
            font-size: 12px !important;
        }

        .slick-prev:before {
            font-family: "Font Awesome 5 Free", sans-serif;
            font-weight: 900;
            content: "\f111";
            color: #52CFCC;
            margin-left: -68px;
            font-size: 12px !important;
        }

        .slick-next:before {
            font-family: "Font Awesome 5 Free", sans-serif;
            font-weight: 900;
            content: "\f111";
            color: #52CFCC;
            font-size: 12px !important;
        }

    </style>
    {{-- Add Css File Here for this page --}}
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection

@section('about', 'menu-active')
@section('body')
    {{-- Write Body Code Here --}}

    <!-- Title of Page Section -->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-10 bg-title-about-div">
                    <div class="title-about-div">
                        <p class="page-about-title">
                            من نحن
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Page and text Section -->
    <section class="mt-md-5 mt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <img src="{{ asset('storage/' . Helper::setting('site.about_us_page_image')) }}" class="w-100">
                </div>
                <div class="col-md-11 mt-3 text-center">
                    <p class="about-text">@setting('site.about_us_page_description')</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Boxes Section -->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row">
                <div class="about-card-style-container col-md-6 mt-md-3 mt-5 position-relative">
                    <div class="card about-card-style pt-5 pl-4 pr-4 pb-5">
                        <div class="card-title text-center m-0">
                            <p class="about-card-title">
                                رؤيتنا
                            </p>
                        </div>
                        <div class="card-text text-center">
                            <p class="about-card-text pr-5 pl-5">@setting('site.our_vision_about_us_page')</p>
                        </div>
                    </div>
                    <img src="{{ asset('assets/images/ophtalmology.svg') }}">
                </div>
                <div class="about-card-style-container col-md-6 mt-md-3 mt-5 position-relative">
                    <div class="card about-card-style pt-5 pl-4 pr-4 pb-5">
                        <div class="card-title text-center m-0">
                            <p class="about-card-title">
                                مهمتنا
                            </p>
                        </div>
                        <div class="card-text text-center">
                            <p class="about-card-text pr-5 pl-5">@setting('site.our_mission_about_us_page')</p>
                        </div>
                    </div>
                    <img src="{{ asset('assets/images/Group 2166.svg') }}">
                </div>
            </div>
        </div>
    </section>

    <!-- Too About (collapse) Section -->
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-md-right text-center">
                    <p class="m-0 too-about-title">
                        أيضاً عن حواس
                    </p>
                </div>

                <div class="col-12">
                    <div id="accordion">
                        @foreach ($collapses as $item)
                            <div class="card card-collapse-style mt-md-4 mt-3" data-toggle="collapse"
                                data-target="#collapse-{{ $item->id }}" aria-expanded="true"
                                aria-controls="collapse-{{ $item->id }}">
                                <div class="card-header header-collapse-style text-md-right text-center" id="headingOne">
                                    <h5 class="card-text-collapse mb-0">
                                        <span class="title-collapse">{{ $item->title }}</span>
                                        <span class="collapse-button">
                                            <i class="collapse_icon fas fa-caret-down collapse-arrow-style"></i>
                                        </span>
                                    </h5>
                                </div>

                                <div id="collapse-{{ $item->id }}" class="collapseCardEvent collapse"
                                    aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="row cardText card-body p-5 text-md-right text-center">
                                        <div class="col-12 text-md-right text-center">
                                            <p class="text-in-collapse">{{ $item->description }}</p>
                                        </div>
                                        @foreach ($item->media as $media)
                                            <div class="col-md-4 mt-3 collapse-image-container">
                                                <img src="{{ asset('storage/' . $media->path) }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Title Gallery -->
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-md-right text-center">
                    <p class="too-about-title">
                        معرض الصور
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Images Gallery -->
    <section style="direction:ltr;" class="pt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-10">
                    <div class="slider slider-single">
                        @foreach ($gallery as $item)
                            <img src="{{ asset('storage/' . $item->path) }}">
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 col-10">
                    <div class="slider slider-nav">
                        @foreach ($gallery as $item)
                            <div>
                                <img src="{{ asset('storage/' . $item->path) }}">
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

    </section>


@endsection


@section('script')
    {{-- Write Js Script Code Here --}}
    <script src="{{ asset('assets/js/components/about.js') }}"></script>
    <script src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>

    <script>
        $('.slider-single').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            arrows: false,
            adaptiveHeight: true,
            infinite: false,
            useTransform: true,
            speed: 400,
            autoplay: true,
            cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',

        });
        $('.slider-single').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
            $('.slider-nav img').parent().removeClass('slider-img-style');
            $('.slider-nav img').eq(nextSlide).parent().addClass('slider-img-style');
        });
        $('.slider-nav')
            .on('init', function(event, slick) {
                $('.slider-nav .slick-slide.slick-current img').eq(0).parent().addClass('slider-img-style');
            })
            .slick({
                slidesToShow: 3,
                rows: 2,
                slidesToScroll: 1,
                dots: false,
                focusOnSelect: false,
                infinite: false,
                arrows: false,
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 5,
                    }
                }, {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    }
                }, {
                    breakpoint: 420,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                }]
            });
        $(document).on('click', '.slider-nav img', function() {
            let index = $('.slider-nav img').index($(this));
            $('.slider-single').slick('slickGoTo', index);
        });

        /*$('.slider-single').on('afterChange', function(event, slick, currentSlide) {
            $('.slider-nav').slick('slickGoTo', currentSlide);
            var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
            $('.slider-nav .slick-slide.is-active').removeClass('is-active');
            $(currrentNavSlideElem).addClass('is-active');
        });*/

        /*$('.slider-nav').on('click', '.slick-slide', function(event) {
            event.preventDefault();
            var goToSingleSlide = $(this).data('slick-index');

            $('.slider-single').slick('slickGoTo', goToSingleSlide);
        });*/

    </script>
@endsection
