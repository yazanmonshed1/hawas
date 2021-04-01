<div class="col-md-10 change-ajax mt-3 text-center">
    <p class="m-0 title-match-question">
        اختر الكلمة المناسبة للفراغ في الفقرات التالية : (السؤال يحتوي على 5 فقرات)
    </p>
</div>
<div class="col-12 mt-md-4 change-ajax mt-3 text-center">
    <div class="answer-box-match text-center val mt-3">
        <p class="answer-text-in-box m-0 p-2">
            القطار
        </p>
    </div>
    <div class=" answer-box-match text-center active val mt-3">
        <p class="answer-text-in-box m-0 p-2">
            الطائرة
        </p>
    </div>
    <div class=" answer-box-match text-center val mt-3">
        <p class="answer-text-in-box m-0 p-2">
            الحافلة
        </p>
    </div>
    <div class=" answer-box-match text-center val  mt-3">
        <p class="answer-text-in-box m-0 p-2">
            السيارة
        </p>
    </div>
</div>
<div class="col-12 text-center mt-5 loading-text loading-ajax">
    <div class="loader text-center m-auto"></div>
</div>
<div class="col-md-9 change-ajax text-md-right text-center mt-md-5 mt-3">
    <p class="question-text">
        {{$question+1}}.سافرت سلمى بالـ ــــــــــــــــــــــــــــــــــــــ، وبينما هي في الجو بدأت تنظر من النافذة للغيوم وأحبت هذا المنظر كثيراً
    </p>
</div>
@if($question+1>1)
    <div class="col-md-6 col-6 back-div text-right mt-md-5 mt-3">
        <a href="{{route('activity.questions')}}"
           data-question="{{$question-1}}"
           class="append_ajax_page">
            <span class="continue-arrow">
            <i class="fas fa-arrow-right"></i>
            </span>
            <span class="continue-text pr-2">
                السابق
            </span>
        </a>
    </div>
@endif
<div class="col-md-6 col-6 next-div float-left mt-md-5 mt-3">
    <a href="{{route('activity.questions')}}"
       data-question="{{$question+1}}"
       class="append_ajax_page">
                            <span class="continue-text pl-2">
                                التالي
                            </span>
        <span class="continue-arrow">
                                <i class="fas fa-arrow-left"></i>
                            </span>
    </a>
</div>

