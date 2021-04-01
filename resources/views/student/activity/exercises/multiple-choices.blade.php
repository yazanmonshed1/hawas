<!-- Washing movies and answer questions -->
{{-- <div id="activity11" class="tab-pane fade"> --}}
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

            8.تمرين مشاهدة فلم واجابة الاسئلة

        </p>
    </div>
</div>
<div class="row m-0 mt-4 mb-5 justify-content-center div-courses" id="multiple-choices-container">
    <div class="col-md-10 mt-3">
        <video class="video-style" width="100%" controls poster="{{ asset('assets/images/platform/snafer.png') }}">
            <source src="{{ asset('assets/video/اغنية شاي كرك المضحكة-eytFQCdL6fs.webm') }}" type="video/webm">
        </video>
    </div>
    <div class="col-12 next-div text-center mb-3 mt-3">
        <a href="" data-num="1" class="go-to-question">
            <span class="continue-text pl-2">
                الى الاسئلة
            </span>
            <span class="continue-arrow">
                <i class="fas fa-arrow-left"></i>
            </span>
        </a>
    </div>
</div>
