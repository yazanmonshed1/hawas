@php
$cards = [];
foreach ($activity->images as $index => $image) {
    $cards[$index]['name'] = 'img' . $image->id;
    $cards[$index]['img'] = asset('storage/' . $image->path);
}

@endphp

<!-- Memory Game -->
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
            <span>
                <img src="{{ asset('assets/images/platform/idea-lamp.svg') }}">
            </span>

            {{ $bookContent->page_number }}.{{ $bookContent->title }}
        </p>
    </div>
    <input type="hidden" value="{{ json_encode($cards) }}" id="cards">
</div>

<!-- Memory Game -->

<div class="d-none" id="time"></div>
<div id="game"></div>
<div class="row justify-content-center mt-3 mb-3">
    <div class="col-md-10 text-center">
        <div class="true-div" style="display: none">
            <span>
                <i class="fas fa-check"></i>
            </span>
            احسنت!
        </div>
        <div class="false-div">
            <span>
                <i class="fas fa-times"></i>
            </span>
            خطأ!
        </div>
    </div>
</div>
