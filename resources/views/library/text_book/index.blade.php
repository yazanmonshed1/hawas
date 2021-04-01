@extends('layouts.app')






@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/insideBook.css') }}">
    {{-- Add Css File Here for this page --}}
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection


@section('body')
    {{-- Write Body Code Here --}}

    <!-- Title Page Section-->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 bg-title-div">
                    <div class="title-div">
                        <p class="book-title">
                            {{ $book->title }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Book Images Section -->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 text-center">
                    <img src="{{ asset('storage/' . $book->back_cover) }}" class="insideBook-img">
                    <img src="{{ asset('storage/' . $book->front_cover) }}" class="insideBook-img">
                </div>
            </div>
        </div>
    </section>



    <!-- Book Parts Section -->
    <section class="mt-md-5 mt-3">
        <div class="container">
            @foreach ($book->parts as $part)

                <div class="row mt-4">
                    <div class="col-12 text-md-right text-center">
                        <p class="part-title">
                            {{$part->title}}
                        </p>
                    </div>

                    <div class="col-12">
                        <div id="accordion-{{$part->id}}">
                            @foreach ($part->collapses as $collapse)
                                <div class="card card-collapse-style mt-3" data-toggle="collapse" data-target="#collapse-{{$collapse->id}}"
                                    aria-expanded="true" aria-controls="collapse-{{$collapse->id}}">
                                    <div class="card-header header-collapse-style text-md-right text-center" id="headingOne">
                                        <h5 class="card-text-collapse mb-0">
                                            <span class="title-collapse">{{$collapse->title}}</span>
                                            <span class="collapse-button pl-2">
                                                <i class="collapse_icon fas fa-caret-down collapse-arrow-style"></i>
                                            </span>
                                        </h5>
                                    </div>

                                    <div id="collapse-{{$collapse->id}}" class="collapseCardEvent collapse" aria-labelledby="headingOne"
                                        data-parent="#accordion-{{$part->id}}">
                                        <div class="row cardText card-body p-5 text-md-right text-center">
                                            @foreach ($collapse->media as $media)
                                                <div class="col-md-4 image-book mb-3">
                                                    <div class="page-opacity">
                                                    </div>
                                                    <div class="zoom-div">
                                                        <a href="#lightbox-target-page"
                                                            class="lightbox lightbox-toggle text-center">
                                                            <div>
                                                                <i class="fas fa-search-plus zoom-icon"></i>
                                                            </div>
                                                            <div>
                                                                <p class="zoom-text">تكبير الصورة</p>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <img src="{{ asset('storage/' . $media->path) }}" class="book-pages-img">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

            @endforeach
        </div>
    </section>




    <div class="lightbox-target" id="lightbox-target-page">
        <img src="{{ asset('assets/images/onePage.png') }}" class="image-in-zoom">
        <a class="lightbox-close" href="#"></a>
    </div>

@endsection


@section('script')
    {{-- Write Js Script Code Here --}}
    <script src="{{ asset('assets/js/components/insideBook.js') }}"></script>
@endsection
