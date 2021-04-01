<!-- Shapes drawing -->
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

<img class="d-none" src="{{ asset('assets/js/components/platform/incline.png') }}" id="incline">
{{-- <div class="cursor position-fixed d-none">
    <img src="{{ asset('storage/dummy/cursor.svg') }}" width="15">
</div> --}}
<div class="d-flex justify-content-around flex-wrap">
    <div class="colors col-md-2 pt-4 text-center">
        @foreach ($activity->colors as $color)
            <div class="circle-color mt-3 {{ $color->color }}"
                style="background-color:{{ $color->color }} ; box-shadow: 0 0 15px {{ $color->color }}">
            </div>
        @endforeach
    </div>
    <canvas id="c" width="400" height="300" style="border:1px solid #ccc"></canvas>
    <div class="controls d-flex flex-column">
        <div id="square" onclick="AddRect()" class="mt-4 square-img-div">
            <img src="{{ asset('assets/images/platform/square.png') }}">
        </div>
        <div id="circle" onclick="AddCircle()" class="mt-4 circle-img-div">
            <img src="{{ asset('assets/images/platform/circle.png') }}">
        </div>
        <div id="triangle" onclick="AddTriangle()" class="mt-4 triangle-img-div">
            <img src="{{ asset('assets/images/platform/triangle.png') }}">
        </div>
        <div id="line" onclick="AddLine()" class="mt-4 line-img-div">
            <img src="{{ asset('assets/images/platform/Line.png') }}">
        </div>
        <div id="sline" onclick="AddTest()" class="mt-4 sline-img-div">
            <img src="{{ asset('assets/images/platform/sline.png') }}">
        </div>
    </div>
</div>
<div id="png-image" class="d-none">
    <h4 class="text-right">{{ __('Answer') }}</h4>
    <div class="content text-center"></div>
</div>
<div class="row justify-content-center mt-2 mb-2">
    <div class="col-md-4 text-center">
        <button type="submit" onclick="exportPNG()" class="finished-button">
            انهيت
        </button>
    </div>
</div>
