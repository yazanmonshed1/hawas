@php
$sentences = $activity->items->shuffle();
$words = $activity->items;
@endphp
<!-- Match word to sentence -->
<div class="row m-0 card-title text-md-right text-center">
    @if ($navigations['previous'])
        <a href="{{$navigations['previous']}}"
            class="col-md-1 col-2 arrow-box-div  text-center">
            <i class="fas fa-arrow-right arrow-box-icon"></i>
        </a>
    @endif
    <div class="col-md-10 col-8 text-center">
        <p class="page-title-activity m-0 pt-2">
            صفحة {{ $bookContent->page_number }}
        </p>
    </div>
    @if ($navigations['next'])
        <a href="{{$navigations['next']}}"
            class="col-md-1 col-2 arrow-box-div  text-center">
            <i class="fas fa-arrow-left arrow-box-icon"></i>
        </a>
    @endif
    <div class="col-12 mt-3 mt-md-2 text-center">
        <p class="course-activity-title">
            <span class="pl-2">
                <img src="{{ asset('assets/images/platform/idea-lamp.svg') }}">
            </span>

            {{ $bookContent->page_number }}.{{ $bookContent->title }}
        </p>
    </div>
</div>

<div id="line-draw-container" class="text-center">
    <div class="row m-0 mt-4 pb-5 justify-content-center row-border-course">
        <div class="col-md-10 mt-3 text-center">
            <p class="m-0 title-match-question">
                صل الكلمة المناسبة في الفراغ في الجمل التالية :
            </p>
        </div>
    </div>

    <div class="app position-relative">
        <div class="d-flex justify-content-between app-content position-absolute w-100">
            <div class="keys d-flex flex-column justify-content-between mw-300">
                @foreach ($sentences as $index => $sentence)
                    @component('common.platform.matchQuestion')
                        @slot('num') {{ $index + 1 }}. @endslot
                        @slot('id') {{ $sentence->id }} @endslot
                        @slot('ques') {{ $sentence->sentence }} @endslot
                    @endcomponent
                @endforeach
            </div>
            <div class="vals d-flex flex-column justify-content-between">
                @foreach ($words as $index => $word)
                    <div id="val-{{ $word->id }}" class="hawas-box-match val mt-3 val-{{ $word->id }}">
                        <p class="hawas-text m-0 p-2">
                            {{ $word->word }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
        <canvas id="canvas" height="400" class="position-relative"></canvas>
        <div id="connection"></div>
    </div>

    <div class="row justify-content-center mt-md-5 mt-2 mb-2">
        <div class="col-md-4 text-center">
            <button type="submit" class="finished-button d-none" id="line-draw-finished">
                انهيت
            </button>
        </div>
    </div>
</div>
