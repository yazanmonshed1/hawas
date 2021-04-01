@extends('layouts.app')






@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/channel.css') }}">
    {{-- Add Css File Here for this page --}}
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection

@section('channel', 'menu-active')
@section('body')
    {{-- Write Body Code Here --}}

    <!-- Title of Page Section -->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 bg-title-channel-div">
                    <div class="title-page-div">
                        <p class="page-channel-title">
                            قناة حواس
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Text of Page -->
    <section class="mt-3 mt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-channel-page">@setting('channel.description')</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Videos Section -->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-md-right text-center">
                    <p class="channel-title">
                        افلام واغاني الحواس
                    </p>
                </div>
            </div>
            <div class="row">
                @forelse ($videos as $video)
                    <div class="col-md-6 mt-2 mt-md-4">
                        <iframe class="youtube-iframe" src="https://www.youtube.com/embed/{{ $video->video_id }}">
                        </iframe>
                        <p class="text-center video-title mt-2">{{ $video->video_title }}</p>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </section>
@endsection


@section('script')
{{-- Write Js Script Code Here --}}
<script src="{{ asset('assets/js/components/library.js') }}"></script>

@endsection
