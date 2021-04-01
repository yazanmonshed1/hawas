@extends('layouts.app')






@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/program.css') }}">
    {{-- Add Css File Here for this page --}}
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection

@section('program', 'menu-active')
@section('program', 'arrow-menu-active')


@section('body')
    {{-- Write Body Code Here --}}

    <!-- Title of Page Section -->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 bg-title-div">
                    <div class="title-div">
                        <p class="page-title">
                            برامجنا
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Text of Page -->
    <section class="mt-md-4 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-page">@setting('site.programs_description')</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Card Section -->
    <section class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mt-3">
                    <a href="{{ route('library', ['text']) }}">
                        @component('common.programCard')
                            @slot('image') dummy/p_library.png @endslot
                            @slot('title') مكتبة حواس @endslot
                        @endcomponent
                    </a>
                </div>
                <div class="col-md-4 mt-3">
                    <a href="{{ route('plays.index') }}">
                        @component('common.programCard')
                            @slot('image') dummy/p_play.png @endslot
                            @slot('title') مسرحيات الحواس @endslot
                        @endcomponent
                    </a>
                </div>
                <div class="col-md-4 mt-3">
                    <a href="{{ route('films.index') }}">
                        @component('common.programCard')
                            @slot('image') dummy/p_movie.png @endslot
                            @slot('title') أفلام الحواس @endslot
                        @endcomponent
                    </a>
                </div>
                <div class="col-md-4 mt-3">
                    <a href="{{ route('channel.index') }}">
                        @component('common.programCard')
                            @slot('image') dummy/p_channel.png @endslot
                            @slot('title') قناة الحواس @endslot
                        @endcomponent
                    </a>
                </div>
                @foreach ($programs as $program)
                    <div class="col-md-4 mt-3">
                        <a href="{{ route('programs.show', [$program->slug]) }}">
                            @component('common.programCard')
                                @slot('image') {{ $program->image }} @endslot
                                @slot('title') {{ $program->name }} @endslot
                            @endcomponent
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection


@section('script')
    {{-- Write Js Script Code Here --}}
    <script src="{{ asset('assets/js/components/library.js') }}"></script>

@endsection
