@extends('layouts.app')

@section('meta_keyword', 'index page meta keyword')
@section('meta_description', 'Your in index page meta description')

@section('title_Page', 'index page')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/Memory-game/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/platform/activity.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/platform/landing.css') }}">

@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection


@section('body')
    {{-- Write Body Code Here --}}

    <!-- Background Section -->
    <section class="image-background-section"></section>


    <!-- Platform Contents Section -->
    <section class="platform-image-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mt-md-0 mt-3">
                    <div class="card card-image-style {{-- card-size --}}">
                        @widget('StudentInfo')
                        <div class="card-body p-2 text-center">
                            @if (isset($pageData))
                                @include('widgets/last_page_entered', ['page' => $pageData])
                            @else
                                @widget('LastPageEntered')
                            @endif
                            <div class="card-title mt-2 back-book-button-div">
                                <a href="{{ route('my-books') }}" class="back-book-button">
                                    <span class="ml-1">
                                        <img src="{{ asset('assets/images/platform/right-arrow.png') }}"
                                            class="arrow-in-button">
                                    </span>
                                    <span class="ml-1">
                                        <img src="{{ asset('assets/images/platform/study-book.png') }}"
                                            class="image-book-in-button">
                                    </span>
                                    <span> العودة الى كتبي </span>
                                </a>
                            </div>
                            <div class="row m-0 last-page-box pt-2 pb-1">
                                <div class="col-12 pr-md-2 text-md-right text-center">
                                    <p class="m-0 last-page-text p-2">
                                        فهرس الكتاب:
                                    </p>
                                </div>
                            </div>
                            <ul class="row last-page-box scroll-div m-0 pr-0 nav nav-tabs no_border_nav0">
                                <a href="javascript:void(0)" class="tab_boxes w-100 p-3">
                                    <p class="m-0 mb-1 activity-text  text-md-right text-center">
                                        لا يوجد محتوى
                                    </p>

                                </a>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-md-9 mt-md-0 mt-3 column-style">
                    @include('student.activity.components.book-content-header', ['book' => $digitalBook])
                    <div class="card card-image-style card-style-flex mt-2">
                        <div class="card-body pb-0 pr-0 pl-0">
                            <h4 class="text-right p-3">لا يوجد محتوى</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
