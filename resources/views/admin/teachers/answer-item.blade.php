@switch($examType)

    @case('painting_images')
    @case('drawing')
    <img src="{{ asset('storage/' . $result) }}" class="w-100" alt="">
    @break

    @case('memory_game')
    <h5>{{ __('Time') }} : {{ $result['time'] }} ثانية</h5>
    <h5>{{ __('Attempts') }} : {{ $result['attempts'] }}</h5>
    @break

    @case('matching_words_to_sentences')
    <table class="table">
        <thead>
            <th>{{ __('Sentence') }}</th>
            <th>{{ __('Word') }}</th>
            {{-- <th>{{ __('Is correct') }}</th> --}}
        </thead>
        <tbody>
            @foreach ($result['answers'] as $answer)
                <tr>
                    <td>{{ $answer->sentence->sentence }}</td>
                    <td>{{ $answer->sentence->word }}</td>
                    {{-- <td>
                        @if ($answer->question_id == $answer->answer_id)
                            <i class="fa fa-check text-success"></i>
                        @else
                            <i class="fa fa-times text-danger"></i>
                        @endif
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <h5 class="font-weight-bold">{{ __('Result') }} : {{ $result['result'] }}</h5>
    @break
    @case('matching_words_to_images')
    <table class="table">
        <thead>
            <th>{{ __('Image') }}</th>
            <th>{{ __('Answer') }}</th>
            <th>{{ __('Is correct') }}</th>
        </thead>
        <tbody>
            @foreach ($result['answers'] as $answer)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $answer->matchImage->image) }}" style="max-height: 80px">
                    </td>
                    <td>{{ $answer->matchImage->title }}</td>
                    <td>
                        @if ($answer->question_id == $answer->answer_id)
                            <i class="fa fa-check text-success"></i>
                        @else
                            <i class="fa fa-times text-danger"></i>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <h5 class="font-weight-bold">{{ __('Result') }} : {{ $result['result'] }}</h5>
    @break
    @case('suitable_words')
    <table class="table">
        <thead>
            <th>{{ __('Sentence') }}</th>
            <th>{{ __('Answer') }}</th>
            <th>{{ __('Is correct') }}</th>
        </thead>
        <tbody>
            @foreach ($result['answers'] as $answer)
                <tr>
                    <td>
                        {{ $answer->question->sentence }}
                    </td>
                    <td>{{ $answer->answer->choice }}</td>
                    <td>
                        @if ($answer->answer->is_correct)
                            <i class="fa fa-check text-success"></i>
                        @else
                            <i class="fa fa-times text-danger"></i>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <h5 class="font-weight-bold">{{ __('Result') }} : {{ $result['result'] }}</h5>
    @break
    @case('videos')
    @case('story')
    <table class="table">
        <thead>
            <th>{{ __('Sentence') }}</th>
            <th>{{ __('Answer') }}</th>
            <th>{{ __('Is correct') }}</th>
        </thead>
        <tbody>
            @foreach ($result['answers'] as $answer)
                <tr>
                    <td>
                        {{ $answer->question->question }}
                    </td>
                    <td>{{ $answer->answer ? $answer->answer->choice : __('Empty') }}</td>
                    <td>
                        @if ($answer->answer && $answer->answer->is_correct)
                            <i class="fa fa-check text-success"></i>
                        @else
                            <i class="fa fa-times text-danger"></i>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <h5 class="font-weight-bold">{{ __('Result') }} : {{ $result['result'] }}</h5>
    @break
    @default
    <h5>{{ $result }}</h5>

@endswitch
