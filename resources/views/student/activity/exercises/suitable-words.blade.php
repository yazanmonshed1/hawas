<!-- Complete the missing word -->
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
<div class="row m-0 mt-4 pb-5 justify-content-center row-border-course row_courses position-relative">
    <div class="col-md-10 mt-md-5 mt-3 text-center">
        {{-- <p class="m-0 title-match-question">
            اختر الكلمة المناسبة للفراغ في الفقرات التالية : (السؤال يحتوي على 5
            فقرات)
        </p> --}}
    </div>

    <div id="question-container"></div>

</div>
