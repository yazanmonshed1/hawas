@extends('layouts.app')

@section('meta_keyword', 'index page meta keyword')
@section('meta_description', 'Your in index page meta description')

@section('title_Page', 'index page')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/platform/landing.css') }}">
    {{-- Add Css File Here for this page --}}
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection


@section('body')
    {{-- Write Body Code Here --}}

    <!-- Background Section -->
    <section class="background-section"></section>


    <!-- Platform Contents Section -->
    <section class="platform-content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mt-md-0 mt-3">
                    <div class="card card-landing-style">
                        @widget('StudentInfo')
                        <div class="card-body p-2 text-center mb-md-5">
                            @widget('LastPageEntered')
                            @widget('UnsolvedProblems')
                            @widget('LatestExamsResults')
                        </div>
                    </div>
                </div>
                <div class="col-md-9 mt-md-0 mt-3">
                    <div class="card card-landing-style">
                        <div class="card-body mb-md-5">
                            <div class="container">
                                <div class="row pt-4 card-title text-md-right text-center">
                                    <div class="col-12">
                                        <img src="{{ asset('assets/images/platform/study-book.png') }}"
                                            class="study-book-img">
                                        <bdi class="title-of-card pr-2">كتبي: </bdi>
                                    </div>
                                </div>

                                @foreach ($booksGrouped as $index => $bookGroup)
                                    <div class="row position-relative {{ $index == 0 ? 'mt-md-4' : 'mt-md-2' }} my-3">
                                        <div class="border-book">
                                        </div>
                                        @foreach ($bookGroup as $book)
                                            @component('common.platform.bookCard')
                                                @slot('intro') {{ asset('storage/' . $book->intro) }} @endslot
                                                @slot('media_type') {{ $book->media_type }} @endslot
                                                @slot('title') {{ $book->title }} @endslot
                                                @slot('url') {{ route('book-activity', ['book_id' => $book->id]) }} @endslot
                                            @endcomponent
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('script')
    {{-- Write Js Script Code Here --}}
    {{-- <script src="{{asset('assets/js/components/about.js')}}"></script> --}}
@endsection
