@extends('layouts.app')






@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/play.css') }}">
    {{-- Add Css File Here for this page --}}
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection


@section('body')
    {{-- Write Body Code Here --}}


    <!-- Title of Page Section -->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 bg-title-play-div">
                    <div class="title-page-div">
                        <p class="page-play-title">
                            مسرحيات الحواس
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Text of Page -->
    <section class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="m-0 text-play-page">@setting('site.plays_description')</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Plays Section -->
    <section class="mt-3">
        <div class="container">
            <div class="row">
                @foreach ($plays as $play)
                    <div class="col-md-4 mt-3 play-img-name">
                        <a href="{{ route('plays.show', [$play->slug]) }}" class="d-block" style="height: 300px">
                            <img src="{{ asset('storage/' . $play->image) }}" class="play-hover-img w-100 h-100">
                            <div class="play-img-opacity" style="height: 300px">
                            </div>
                            <div class="play-name-div">
                                <div>
                                    <p class="play-name text-center mb-0">{{ $play->title }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection


@section('script')
    {{-- Write Js Script Code Here --}}
    <script src="{{ asset('assets/js/components/play.js') }}"></script>


@endsection
