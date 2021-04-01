@extends('admin.layouts.dashboard')

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('Book contents') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Default Datatable</h4>
                    <p class="card-title-desc">اضغط على المتحتوى لعرض النتائج.</p>

                    <div class="contents p-4">
                        @foreach ($contents as $index => $content)
                            <a href="{{ route('admin.teachers.students.exams', ['book_content_id' => $content->id]) }}"
                                class="d-flex justify-content-between align-items-center border p-3 mb-4">
                                <h5>{{ $index + 1 }}. {{ $content->title }}</h5>
                                <h5>{{ __('Show students answers') }}</h5>
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
