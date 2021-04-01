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
                            <ul class="last-page-box scroll-div m-0 px-0 nav-tabs no_border_nav0">
                                @foreach ($digitalBook->chapters->sortBy('order') as $idx => $chapterItem)
                                    <li class="col-12 pr-md-3 activity-border course-name mt-md-2 mt-3">
                                        @component('common.platform.activity-tabMenu')
                                            @slot('class')
                                                {{ $chapterItem->id == $chapter->id ? 'course-name-active' : '' }}
                                            @endslot
                                            @slot('href')
                                                {{ route('book-activity', ['book_id' => $digitalBook->id, 'chapter_id' => $chapterItem->id]) }}
                                            @endslot
                                            @slot('text') {{ $chapterItem->chapter }} @endslot
                                            @slot('num') {{ $idx + 1 }} @endslot
                                        @endcomponent
                                    </li>
                                @endforeach
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-md-9 mt-md-0 mt-3 column-style">
                    @include('student.activity.components.book-content-header', ['book' => $digitalBook])
                    <div class="card card-image-style card-style-flex mt-2 h-auto last-page-box" style="max-height: 765px; overflow-y: scroll">
                        <div class="card-body pb-0 pr-0 pl-0">
                            @forelse ($chapter->contents()->orderBy('page_number')->get() as $idx => $content)
                                <div class="activity-border course-name text-right p-3">
                                    <a
                                        class="text-right"
                                        style="font-family: Amiri"
                                        href="{{ route('book-activity', ['book_id' => $digitalBook->id, 'chapter_id' => $chapter->id, 'activity_id' => $content->id]) }}">
                                        {{ $content->page_number . ' ' . $content->title }}
                                    </a>
                                </div>
                            @empty
                                <h4 class="p-5 text-right" style="font-family: Amiri-Bold">لا يوجد محتوى</h4>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

@endsection
