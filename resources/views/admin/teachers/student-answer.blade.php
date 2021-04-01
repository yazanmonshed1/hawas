@extends('admin.layouts.dashboard')

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('Student answer') }}</h4>
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
                        <h5 class="font-weight-bold">{{ __('Answer') }} :</h5>
                        {{-- {{dd($examType)}} --}}
                        {{-- {{dd($result)}} --}}
                        @include('admin.teachers.answer-item', ['examType' => $examType, 'result' => $result])
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
