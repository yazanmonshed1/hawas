<!-- Puzzle Images -->
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
</div>
<div class="row m-0 justify-content-center ">
    <div class="col-md-10 mt-md-4 mt-3 mb-3 text-center">
        @foreach ($activity->parts as $index => $part)
            <div class="piece-box text-center {{ $index == 0 ? 'active' : '' }} val mt-3">
                <p valuex="{{ $part->x }}" valuey="{{ $part->y }}" class="part piece-box-text m-0 p-2">
                    {{ $part->x * $part->y }} قطع
                </p>
            </div>
        @endforeach
    </div>

    <img src="{{ asset('storage/' . $activity->image) }}" id="puzzle_image" class="w-100">
    <input type="hidden" id="piecesx" value="{{ $activity->parts[0]->x }}" class="forminput" />
    <input type="hidden" id="piecesy" value="{{ $activity->parts[0]->y }}" class="forminput" />

    <div class="canvaswrapper" id="canvasparent">
        <canvas id="canvas" class="canvas" style="border: 1px solid"></canvas>
    </div>

</div>
<div class="row justify-content-center mt-2 mb-2">
    <div class="col-md-4 text-center">
        <button type="submit" class="finished-button" id="puzzle-finished" disabled>
            انهيت
        </button>
    </div>
</div>
