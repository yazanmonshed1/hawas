@extends('layouts.app')






@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/play.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/lightbox/lightbox.min.css') }}">
    {{-- Add Css File Here for this page --}}
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}
@endsection


@section('body')
    {{-- Write Body Code Here --}}


    <!-- Title of Play Name Section -->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 bg-title-play-name">
                    <div class="title-play-name">
                        <p class="page-play-name">{{ $play->title }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image and Text of Play Section -->
    <section class="mt-md-5 mt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 overflow-hidden" style="height: 300px">
                    <img src="{{ asset('storage/' . $play->header_image) }}" class="w-100">
                </div>
                <div class="col-12 mt-md-4 mt-3 text-center">
                    <p class="text-play-name">{{ $play->description }}</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Images From Plays Section -->
    <section class="mt-md-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-md-right text-center">
                    <p class="m-0 img-title">
                        صور من المسرحية
                    </p>
                </div>
            </div>
            <div class="row">
                @foreach ($play->media as $media)
                    <div class="col-md-4 mt-3 play-img">
                        <a class="demo" href="{{ asset('storage/' . $media->path) }}" data-lightbox="example">
                            <img src="{{ asset('storage/' . $media->path) }}" class="w-100">
                            <div class="play-img-zoom-opacity">
                            </div>
                            <div class="insidePlay-name-div">
                                <div class="play-zoom text-center">
                                    <i class="fas fa-search-plus play-zoom-icon"></i>
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
                    <source src="{{ asset('storage/' . $play->video) }}" />
                </video>
            </div>
        </div>
    </section>


@endsection


@section('script')
    {{-- Write Js Script Code Here --}}

    <script src="{{ asset('assets/js/components/play.js') }}"></script>

@endsection
