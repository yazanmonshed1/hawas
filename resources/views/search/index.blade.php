@extends('layouts.app')






@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/search.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/play.css') }}">
    {{-- Add Css File Here for this page --}}
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection


@section('body')
    {{-- Write Body Code Here --}}

    <!-- Title of Page Section -->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-10 bg-title-search-div">
                    <div class="title-search-div">
                        <p class="page-search-title">
                            نتائج البحث
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Title and Search bar Section-->
    <section class="mt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <p class="search-title">
                        ابحث في حواس
                    </p>
                </div>
                <div class="col-md-5 text-center">
                    <form action="{{ route('search') }}" method="GET" class="search-page-container position-relative">
                        <input value="{{ request()->has('search') ? request()->get('search') : '' }}" type="text"
                            class="search-page" name="search">
                        <button type="submit" class="search-page-button">
                            <i class="fa fa-search search-page-icon"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Result from Search Section -->
    <section class="mt-md-5 mt-3" id="page">
        <div class="container">
            @if (request()->get('search') && $textBooks->count() == 0 && $digitalBooks->count() == 0 && $blogs->count() == 0 && $plays->count() == 0)
                <div class="text-center">
                    <img src="{{ asset('storage/dummy/404.png') }}" alt="">
                    <h4 class="mt-4 color-yellow" style="font-family: Tajawal-Bold, sans-serif">{{ __('No results') }}
                    </h4>
                </div>
            @endif
            @if ($textBooks->count())
                <h4 class="text-right mt-5">الكتب الورقية</h4>
                <div class="row">

                    @foreach ($textBooks as $book)
                        @component('common.searchCard')
                            @slot('class') book-img-card @endslot
                            @slot('title') {{ $book->title }} @endslot
                            @slot('image') {{ $book->front_cover }} @endslot
                            @slot('text') {{ $book->description }}@endslot
                            @endcomponent
                        @endforeach
                    </div>
                @endif
                @if ($digitalBooks->count())
                    <h4 class="text-right mt-5">الكتب الرقمية</h4>

                    <div class="row">
                        @foreach ($digitalBooks as $book)
                            @component('common.searchCard')
                                @slot('class') search-img-card @endslot
                                @slot('title') {{ $book->title }} @endslot
                                @slot('image') {{ $book->intro }} @endslot
                                @slot('text') {{ $book->description }}@endslot
                                @endcomponent
                            @endforeach
                        </div>
                    @endif
                    @if ($blogs->count())
                        <h4 class="text-right mt-5">المدونة</h4>

                        <div class="row">
                            @foreach ($blogs as $blog)
                                @component('common.searchCard')
                                    @slot('class') search-card-style @endslot
                                    @slot('title') {{ ' ' . $blog->title }} @endslot
                                    @slot('image') {{ $blog->image }} @endslot
                                    @slot('text') {{ $blog->brief }}@endslot
                                    @endcomponent
                                @endforeach
                            </div>
                        @endif
                        @if ($plays->count())
                            <h4 class="text-right mt-5">المسرحيات</h4>

                            <div class="row">
                                @foreach ($plays as $play)
                                    <div class="col-md-4 mt-3 play-img-name">
                                        <a href="{{ route('plays.show', [$play->slug]) }}">
                                            <img src="{{ asset('storage/' . $play->image) }}" class="w-100">
                                            <div class="play-img-opacity">
                                            </div>
                                            <div class="play-name-div">
                                                <div>
                                                    <p class="play-name text-center">{{ $play->title }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </section>
            @endsection


            @section('script')
                {{-- Write Js Script Code Here --}}
                <script src="{{ asset('assets/js/components/about.js') }}"></script>
                <script src="{{ asset('assets/js/components/play.js') }}"></script>
                <script>
                    
                    let _word = "{{ request()->has('search') ? request()->get('search') : false }}"
                    if (_word) {
                        var element = document.getElementById(
                        "page"); // if you want to get the element by ID: document.getElementById("your-element");
                        var originalHtml = element.innerHTML;
                        var newHtml = originalHtml.replaceAll(_word, _word.fontcolor("#4682FC"));
                        console.log(newHtml)
                        element.innerHTML = newHtml;
                    }

                </script>
            @endsection
