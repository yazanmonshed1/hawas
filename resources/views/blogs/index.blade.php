@extends('layouts.app')

@section('meta_keyword','index page meta keyword')
@section('meta_description','Your in index page meta description')

@section('title_Page','index page')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/components/blog.css')}}">
    {{--  Add Css File Here for this page  --}}
@endsection

@section('fonts')
    {{--  Add Fonts Url Here for this page  --}}

@endsection

@section('blog','menu-active')

@section('body')
    {{--  Write Body Code Here  --}}

    <!-- Title Page Section-->
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

    <!-- Blogs Section -->

    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog)
                    @include('common.blogCard', ['blog' => $blog])
                @endforeach
            </div>
        </div>
    </section>
@endsection


@section('script')
    {{--  Write Js Script Code Here  --}}
@endsection
