@extends('admin.layouts.dashboard')

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('Student exams') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{ $bookContent->title }}</h4>
                    <p class="card-title-desc">اضغط على اسم الطالب لعرض الجواب.</p>

                    <div class="contents p-4">
                        @foreach ($exams as $exam)
                            <a @if ($exam->type != 'puzzles') href="{{ route('admin.teachers.students.answers', ['book_content_id' => $bookContent->id, 'student_id' => $exam->user->id]) }}" @endif class="d-flex justify-content-between align-items-center border p-3">
                                <h5>{{ $exam->user->name }}</h5>
                                @if ($exam->type == 'puzzles')
                                    <h5><i class="fa fa-check text-success"></i></h5>
                                @else
                                    <h5>{{ __('Show answer') }}</h5>
                                @endif
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
