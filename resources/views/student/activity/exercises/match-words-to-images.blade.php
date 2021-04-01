@php
$images = $activity;
$words = $activity->shuffle();
@endphp
<!-- Match activity to word -->
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
            {{ $bookContent->page_number }}. {{ $bookContent->title }}
        </p>
    </div>
</div>
<div id="line-draw-container" class="text-center">
    <div class="row m-0 mt-4 justify-content-center row-border-course">
        <div class="col-12">
            <div class="app position-relative">
                <div class="d-flex justify-content-between app-content position-absolute w-100">
                    <div class="row mt-3 mb-4">
                        <div class="col-md-8 text-center keys">
                            @foreach ($images as $image)
                                <div class="match-word-to-image-image">
                                    <div class="mt-4 position-relative">
                                        <img id="key-{{ $image->id }}"
                                            src="{{ asset('storage/' . $image->image) }}"
                                            class=" key key-{{ $image->id }}" style="height: 150px;width: 150px">
                                    </div>
                                    <div class="arrow-match">
                                        <img src="{{ asset('assets/images/platform/arrow-match.png') }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 mb-md-0 mb-3 text-center">
                        <div class="row justify-content-center h-100">
                            <div class="d-flex flex-column justify-content-around text-center vals">
                                @foreach ($words as $word)
                                    <div id="val-{{ $word->id }}"
                                        class="hawas-box-match val val-{{ $word->id }} mt-md-4 mt-3">
                                        <p class="hawas-text m-0 p-2">
                                            {{ $word->title }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <canvas id="canvas" height="750" class="position-relative"></canvas>
                <div id="connection"></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-md-4 mt-2 mb-2">
        <div class="col-md-4 text-center">
            <button type="submit" class="finished-button d-none" id="line-draw-finished">
                انهيت
            </button>
        </div>
    </div>

</div>
