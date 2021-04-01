<div class="row m-0 practice-box mt-2 pt-2 pb-4">
    <div class="col-12 text-center mb-2">
        <p class="m-0 last-page-text">
            تمارين غير محلولة
        </p>
    </div>
    @forelse ($unsolvedQuestions as $unsolved)
        <div class="col-12 text-md-right text-center mt-2">
            <span class="mb-1 practice-num">
                @if (array_key_exists('q_no', $unsolved))
                    تمرين {{ $unsolved['q_no'] }} /
                @elseif(array_key_exists('title', $unsolved))
                    {{ $unsolved['title'] }} /
                @endif
                ص{{ $unsolved['page_no'] }}
            </span>
            <a href="{{ $unsolved['link'] }}" class="float-left practice-link">
                حل التمرين
            </a>
        </div>
    @empty
        <div class="text-center w-100">
            <small style="font-family: Tajawal-Bold, sans-serif">{{ __('No unsolved exercises') }}</small>
        </div>
    @endforelse

</div>
