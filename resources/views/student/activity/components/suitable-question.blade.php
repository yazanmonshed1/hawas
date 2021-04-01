<div id="question-id" target-id="{{ $question->id }}"></div>
<div class="col-12 d-flex flex-wrap mt-md-4 mt-3 text-center justify-content-center">
    @foreach ($question->choices->shuffle() as $choice)
        <div class="answer-box-match text-center val mt-3 d-flex justify-content-center align-items-center">
            <p class="answer-text-in-box cursor-pointer {{ isset($answer_id) && $answer_id == $choice->id ? 'active' : '' }} m-0 p-2 w-100 h-100"
                target-id="{{ $choice->id }}">
                {{ $choice->choice }}
            </p>
        </div>
    @endforeach
</div>
<div class="text-center loading-text loading-ajax">
    <div class="loader text-center m-auto"></div>
</div>
<div class="text-md-right text-center mt-md-5 mt-3">
    <p class="question-text px-3">
        <span id="q_no">{{ $q_no }}</span>.{{ $question->sentence }}
    </p>

</div>
<div class="d-flex justify-content-between">
    <div>
        <a href="" class="{{ (isset($hide) && $hide == 'first') || $one ? 'd-none' : 'd-block' }} get-question" navigate="previous">
            <span class="continue-arrow">
                <i class="fas fa-arrow-right"></i>
            </span>
            <span class="continue-text pl-2">
                السابق
            </span>
        </a>
    </div>
    <div>
        <a href="" class="{{ isset($hide) && $hide == 'last' ? 'd-none' : 'd-block' }} get-question" navigate="next">
            <span class="continue-text pl-2">
                التالي
            </span>
            <span class="continue-arrow">
                <i class="fas fa-arrow-left"></i>
            </span>
        </a>
    </div>
</div>
<div class="row justify-content-center mt-md-5 mt-2 mb-2">
    <div class="text-center">
        <button type="submit" id="finished-button" class="finished-button {{ !$finished ? 'd-none' : '' }}">
            انهيت
        </button>
    </div>
</div>
