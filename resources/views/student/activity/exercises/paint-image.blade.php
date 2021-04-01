<!-- Painting Images -->
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
<div class="row m-0 mt-4 mb-5 justify-content-between row-border-course">
    <div class="app-container d-flex justify-content-between" style="position: relative">
        <div class="cursor">
            <img src="{{ asset('storage/dummy/cursor.svg') }}" class="brush-img" style="height: 35px;width: 35px">
        </div>
        <canvas id="myCanvas" width="500" height="200" style="border:2px solid black"></canvas>
        <img id="target-image" src="{{ asset('storage/' . $activity->image) }}" class="w-100">
    </div>

    <div class="col-md-2 pt-4 mb-md-0 mb-4 text-center">
        @foreach ($activity->colors as $color)
            <div class="circle-color mt-3"
                style="background-color:{{ $color->color }} ; box-shadow: 0 0 15px {{ $color->color }}">
            </div>
        @endforeach
    </div>
</div>
<div class="d-flex justify-content-around align-items-end">
    <div class="form-group d-flex align-items-start flex-column flex-1 ml-3">
        <label style="color: inherit" for="">عرض الخط :</label>
        <input id="selWidth" class="form-control" type="range" min="1" max="11" value="9">
    </div>
    <div class="form-group">
        <button class="btn btn-danger" onclick="javascript:clearArea();return false;">مسح</button>
    </div>
</div>
<div id="png-image" class="d-none">
    <h4 class="text-right">{{ __('Answer') }}</h4>
    <div class="content text-center"></div>
</div>
<div class="row justify-content-center mt-2 mb-2">
    <div class="col-md-4 text-center">
        <button type="submit" class="finished-button" onclick="exportPNG()">
            انهيت
        </button>
    </div>
</div>

<div id="blank-space" style="width: 0;height: 35px"></div>
