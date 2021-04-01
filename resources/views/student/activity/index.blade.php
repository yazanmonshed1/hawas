@extends('layouts.app')

@section('meta_keyword', 'index page meta keyword')
@section('meta_description', 'Your in index page meta description')

@section('title_Page', 'index page')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/Memory-game/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/platform/activity.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/platform/landing.css') }}">
    {{-- Add Css File Here for this page --}}

    @if ($activityData['viewName'] == 'exercises.match-words-to-sentences' || $activityData['viewName'] == 'exercises.match-words-to-images')
        <link rel="stylesheet" href="{{ asset('assets/css/components/platform/domarrow.css') }}">
    @endif

    @if ($activityData['viewName'] == 'exercises.memory-game')
        <link rel="stylesheet" href="{{ asset('assets/css/components/platform/memory.css') }}">
    @endif

    {{-- @if ($activityData['viewName'] == 'exercises.memory-game')
        <link rel="stylesheet" href="{{ asset('assets/css/components/platform/memory.css') }}">
    @endif --}}

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
                            @if ($pageData)
                                @include('widgets/last_page_entered', ['page' => $pageData])
                            @else
                                @widget('LastPageEntered')
                            @endif
                            <div class="card-title mt-2 back-book-button-div">
                                <a href="{{ route('my-books') }}" class="back-book-button">
                                    <span class="ml-1">
                                        <img src="{{ asset('assets/images/platform/right-arrow.png') }}"
                                            class="arrow-in-button">
                                        {{-- <i class="fas fa-arrow-right"></i> --}}
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
                                @foreach ($digitalBook->chapters->sortBy('order') as $idx => $chapter)
                                    <li class="col-12 pr-md-3 activity-border course-name mt-md-2 mt-3">
                                        @component('common.platform.activity-tabMenu')
                                            @slot('class')
                                                {{ $chapter->id == $chapter_id ? 'course-name-active' : '' }}
                                            @endslot
                                            @slot('href')
                                                {{ route('book-activity', ['book_id' => $digitalBook->id, 'chapter_id' => $chapter->id]) }}
                                            @endslot
                                            @slot('text') {{ $chapter->chapter }} @endslot
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
                    <div class="card card-image-style card-style-flex mt-2">
                        <div class="card-body pb-0 pr-0 pl-0" id="fullscreen-container">
                            <div class="container" id="student-exam-id" target-id="{{ isset($exam) ? $exam->id : '' }}"
                                exam-type="{{ isset($exam) ? $exam->type : '' }}">
                                <button onclick="fullscreen()" type="button" class="btn">
                                    <i class="fa fa-arrows-alt text-secondary rotate-45"></i>
                                    <span style="font-family:Tajawal-Bold, sans-serif" class="text-secondary">{{ __('Fullscreen') }}</span>
                                </button>
                                @if (isset($activityData) && $activityData != null)
                                    @include('student.activity.' . $activityData['viewName'], [
                                    'activity' => $activityData['activity'],
                                    'bookContent' => $activityData['bookContent'],
                                    'navigations' => $navigations
                                    ])
                                @endif
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
    @if (isset($exam))
        <script src="{{ asset('assets/js/components/platform/activity.js') }}"></script>
    @endif

    @if ($activityData['viewName'] == 'exercises.suitable-words')
        <script src="{{ asset('assets/js/components/platform/suitable_exam.js') }}"></script>
    @endif
    @if ($activityData['viewName'] == 'exercises.memory-game')
        <script src="{{ asset('assets/js/components/platform/memory.js') }}"></script>
    @endif

    {{-- Drawing game --}}
    @if ($activityData['viewName'] == 'exercises.shapes-drawing')
        <script src="{{ asset('assets/js/components/platform/fabric.js') }}"></script>
        <script src="{{ asset('assets/js/components/platform/drawing.js') }}"></script>
    @endif
    @if ($activityData['viewName'] == 'exercises.paint-image')
        <script src="{{ asset('assets/js/components/platform/coloring.js') }}"></script>
    @endif
    @if ($activityData['viewName'] == 'exercises.match-words-to-sentences' || $activityData['viewName'] == 'exercises.match-words-to-images')
        <script src="{{ asset('assets/js/components/platform/domarrow.js') }}"></script>
        <script src="{{ asset('assets/js/components/platform/line-draw.js') }}"></script>
    @endif

    {{-- {{dd($activityData['viewName'])}} --}}
    @if ($activityData['viewName'] == 'exercises.puzzle')
        <script src="{{ asset('assets/js/components/platform/jigsaw.min.js') }}"></script>
        <script src="{{ asset('assets/js/components/platform/puzzle.js') }}"></script>
    @endif

    @if ($activityData['viewName'] == 'lessons.video' || $activityData['viewName'] == 'lessons.story')
        <script src="{{ asset('assets/js/components/platform/multiple_choices.js') }}"></script>
    @endif

    <script>
        function fullscreen() {
            if (
                document.fullscreenElement ||
                document.webkitFullscreenElement ||
                document.mozFullScreenElement ||
                document.msFullscreenElement
            ) {
                document.querySelector('#fullscreen-container i').classList.remove('fa-times')
                document.querySelector('#fullscreen-container i').classList.add('fa-arrows-alt')
                document.querySelector('#fullscreen-container i').classList.add('rotate-45')
                document.querySelector('#fullscreen-container span').textContent = 'ملئ الشاشة'
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            } else {
                document.querySelector('#fullscreen-container i').classList.remove('fa-arrows-alt')
                document.querySelector('#fullscreen-container i').classList.add('fa-times')
                document.querySelector('#fullscreen-container i').classList.remove('rotate-45')
                document.querySelector('#fullscreen-container span').textContent = 'اغلاق الشاشة'
                element = document.getElementById('fullscreen-container');
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.mozRequestFullScreen) {
                    element.mozRequestFullScreen();
                } else if (element.webkitRequestFullscreen) {
                    element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                } else if (element.msRequestFullscreen) {
                    element.msRequestFullscreen();
                }
            }
        }

    </script>

@endsection
