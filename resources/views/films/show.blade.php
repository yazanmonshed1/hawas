@extends('layouts.app')






@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/film.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/lightbox/lightbox.min.css') }}">
    {{-- Add Css File Here for this page --}}
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection


@section('body')
    {{-- Write Body Code Here --}}

    <!-- Title of Film Name Section -->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 bg-title-film-name">
                    <div class="title-film-name">
                        <p class="page-film-name">
                            {{ $film->title }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image and Text of Film Section -->
    <section class="mt-md-5 mt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 overflow-hidden" style="height: 300px">
                    <img src="{{ asset('storage/' . $film->header_image) }}" class="w-100">
                </div>
                <div class="col-12 mt-md-4 mt-3 text-center">
                    <p class="text-film-name">{{ $film->description }}</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Images From Films(Plays) Section -->

    <section class="mt-md-5 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12 text-md-right text-center">
                    <p class="img-title">
                        صور من الفلم
                    </p>
                </div>
            </div>
            <div class="row">
                @foreach ($film->media as $media)
                    <div class="col-md-4 mt-3 film-img">
                        <!-- href: Full activity
                                        img: resized Image -->
                        <a class="demo" href="{{ asset('storage/' . $media->path) }}" data-lightbox="example">
                            <img src="{{ asset('storage/' . $media->path) }}" class="w-100">
                            <div class="film-img-zoom-opacity">
                            </div>
                            <div class="film-name-div">
                                <div class="film-zoom text-center">
                                    <i class="fas fa-search-plus film-zoom-icon"></i>
                                    <p class="zoom-text">تكبير الصورة</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mt-md-5 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12 text-md-right text-center">
                    <p class="img-title">
                        فيديو
                    </p>
                </div>
            </div>
            <div class="mt-3">
                <video controls class="w-100">
                    <source src="{{ asset('storage/' . $film->video) }}" />
                </video>
            </div>
        </div>
    </section>

@endsection


@section('script')
    {{-- Write Js Script Code Here --}}
    <script src="{{ asset('assets/js/components/film.js') }}"></script>



@endsection
