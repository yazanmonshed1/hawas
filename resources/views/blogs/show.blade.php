@extends('layouts.app')






@section('style')
    {{-- Add Css File Here for this page --}}
    <link rel="stylesheet" href="{{ asset('assets/css/components/blogShow.css') }}">
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection


@section('body')
    {{-- Write Body Code Here --}}

    <!-- Page Title Section -->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 bg-title-div">
                    <div class="title-div">
                        <p class="page-title">
                            المدونة
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Details Section -->
    <section class="mt-3">
        <div class="container">
            <div class="text-blog">
                <img class="blog-image pl-3" src="{{ asset('storage/' . $blog->image) }}">
                <div class="d-inline-block blog-time-container ml-4 pt-3">
                    <span class="" data-open-accessibility-text-original="16px" style="font-size: 16px;">
                        <i class="far fa-calendar calender-icon"></i>
                    </span>
                    <bdi class="blog-time pr-1">
                        {{ $blog->created_at->formatLocalized('%A %d, %B, %Y') }}
                    </bdi>
                </div>
                <p class="title-blog text-md-right text-center mb-2 mt-3">{{ $blog->title }}</p>
                {!! $blog->body !!}
            </div>
        </div>
    </section>

    <!-- More Blog Section -->
    <section class="mt-3 mt-md-5 d-inline-block w-100">
        <div class="container">
            <div class="row">
                <div class="col-12 text-md-right text-center">
                    <p class="title-more">
                        قد يهمك أيضاَ
                    </p>
                </div>
                <div class="col-12 w-100">
                    <div class="row">
                        @foreach ($blogs as $item)
                            <div class="col-md-3 mt-md-0 mt-4">
                                <div class="card blog-card-style h-100 d-flex blog-card-equalizer">
                                    <div class="img-container">
                                        <img class="card-img-top" src="{{ asset('storage/' . $item->image) }}"
                                            alt="Card image cap">
                                    </div>
                                    <div class="card-body p-1 text-md-right text-center d-flex justify-content-end flex-column">
                                        <p class="blog-card-title mt-md-1 mt-3 mb-2">{{ $item->title }} </p>
                                        <p class="blog-card-text mb-2">{{ mb_strimwidth($item->brief, 0, 60, '...') }}</p>
                                        <a class="btn moreButton" href="{{ route('blogs.show', [$item->slug]) }}">
                                            <span class="moreText">المزيد</span>
                                            <span class="moreLeftArrow">
                                                <i class="fas fa-long-arrow-alt-left"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    {{-- Write Js Script Code Here --}}
@endsection
