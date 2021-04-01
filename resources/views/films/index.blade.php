@extends('layouts.app')






@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/film.css') }}">
    {{-- Add Css File Here for this page --}}
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection


@section('body')
    {{-- Write Body Code Here --}}

    <section class="mt-3">
        <!-- Title of Page Section -->
        <section class="mt-3 mt-md-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 bg-title-film-div">
                        <div class="title-page-div">
                            <p class="page-film-title">
                                أفلام حواس
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Text of Page -->
        <section class="mt-3 mt-md-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="text-film-page">
                            العديد من المسرحيات الكوميدية والغنائية التربوية من انتاج وتأليف واخراج مؤسسة حواس, جميعها تهدف
                            الى ترسيخ الوعي الصحي والسلوك الامن
                        </p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Films Section -->

        <div class="container">
            <div class="row">
                @foreach ($films as $film)
                    <div class="col-md-4 mt-3 film-img-name">
                        <a href="{{ route('films.show', [$film->slug]) }}">
                            <img src="{{ asset('storage/' . $film->image) }}" class="w-100" height="300px">
                            <div class="film-img-opacity">
                            </div>
                            <div class="film-name-div">
                                <div>
                                    <p class="film-name text-center">فلم السيلفي الاخير</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- <div class="lb-nav"
         style="display: block;
         pointer-events: auto;">
        <a class="lb-prev" aria-label="Previous activity" href="" style="display: block;">

        </a>
        <a class="lb-next" aria-label="Next activity" href="" style="display: block;">

        </a>
    </div> --}}

@endsection


@section('script')
    {{-- Write Js Script Code Here --}}
    <script src="{{ asset('assets/js/components/film.js') }}"></script>


@endsection
