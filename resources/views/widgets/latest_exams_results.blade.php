<div class="row mt-3 m-0">
    <div class="col-12 text-center">
        <p class="practice-result">نتائج آخر التمارين</p>
    </div>
</div>

@foreach ($examResults as $studentExam)
    <div class="row m-0 mt-2 pt-2 practice-result-box">
        <div class="col-9">
            <p class="m-0 book-name-in-result">
                {{ $studentExam->bookContent->book->title }} / {{ $studentExam->bookContent->title }}
            </p>
            <p class="mb-2 practice-result-num text-md-right text-center">
                تمرين {{ $studentExam->bookContent->page_number }} / ص{{ $studentExam->bookContent->page_number }}
            </p>
        </div>
        <div class="col-3 pr-0">
            @if (in_array($studentExam->bookContent->table_name, config('enums.has_result')))
                <div class="result-practice-{{ $studentExam->mark < $studentExam->total / 2 ? 'red' : 'green' }}">
                    <p class="result-num">
                        {{ $studentExam->mark }}/{{ $studentExam->total }}
                    </p>
                </div>
            @else
                <div class="result-practice-blue">
                    <p class="result-num">
                        <i class="fas fa-check check-icon"></i>
                    </p>
                </div>
            @endif
        </div>
    </div>
@endforeach
