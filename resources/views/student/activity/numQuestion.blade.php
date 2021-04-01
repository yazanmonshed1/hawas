<div class="col-md-10 mt-3 change-ajax text-center">
    {{-- <p class="m-0 title-match-question">
        اختر الكلمة المناسبة للفراغ في الفقرات التالية : (السؤال يحتوي على {{$question->choices->count()}} فقرات)
    </p> --}}
</div>
<div class="d-none" id="q_no">{{ $q_no }}</div>
<div class="col-md-11 text-md-right change-ajax text-center mt-md-5 mt-3" id="question-id"
    target-id="{{ $question->id }}">
    <div class="answer-button">
        <p class="question-text">
            {{ $q_no }}.{{ $question->question }}:
        </p>
        @foreach ($question->choices->shuffle() as $choice)
            <div class="label-answer-div multiple-choice-answer" target-id="{{ $choice->id }}">
                <label class="radio-answer">{{ $choice->choice }}
                    <input {{ $answer_id == $choice->id ? 'checked' : '' }} type="radio" name="radio">
                    <span class="checkmark"></span>
                </label>
            </div>
        @endforeach
    </div>

</div>
<div class="col-12 text-center mt-5 loading-text loading-ajax">
    <div class="loader text-center m-auto"></div>
</div>
<div class="col-md-6 col-6 back-div text-right mt-md-5 mt-3">
    <a href="" class="{{ (isset($hide) && $hide == 'first') || $one ? 'd-none' : 'd-block' }} go-to-question"
        navigate="previous">
        <span class="continue-arrow">
            <i class="fas fa-arrow-right"></i>
        </span>
        <span class="continue-text pr-2">
            السابق
        </span>
    </a>
</div>
<div class="col-md-6 col-6 next-div float-left mt-md-5 mt-3 mb-3">
    <a href="" class="{{ isset($hide) && $hide == 'last' ? 'd-none' : 'd-block' }} go-to-question" navigate="next">
        <span class="continue-text pl-2">
            التالي
        </span>
        <span class="continue-arrow">
            <i class="fas fa-arrow-left"></i>
        </span>
    </a>
</div>
<div class="col-md-4 text-center mb-3">
    <button type="submit" class="finished-button {{!$finished ? 'd-none' : ''}}" id="finished-button">
        انهيت
    </button>
</div>
