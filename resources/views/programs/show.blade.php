@extends('layouts.app')






@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/workshop.css') }}">
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
                <div class="col-12 bg-title-workshop-div">
                    <div class="title-page-div">
                        <p class="page-workshop-title">{{ $program->name }}</p>
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
                    <p class="text-workshop-page">{{ $program->description }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Card Section -->
    <section class="mt-3">
        <div class="container">
            <div class="row">
                @foreach ($program->media as $media)
                    @component('common.workshopImage')
                        @slot('image') {{ $media->path }} @endslot
                    @endcomponent
                @endforeach
            </div>

        </div>
    </section>
@endsection


@section('script')
    {{-- Write Js Script Code Here --}}
    <script src="{{ asset('assets/js/components/library.js') }}"></script>

@endsection
