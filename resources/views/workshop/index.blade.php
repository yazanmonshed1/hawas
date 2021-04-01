@extends('layouts.app')

@section('meta_keyword','index page meta keyword')
@section('meta_description','Your in index page meta description')

@section('title_Page','index page')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/components/workshop.css')}}">
    {{--  Add Css File Here for this page  --}}
@endsection

@section('fonts')
    {{--  Add Fonts Url Here for this page  --}}

@endsection


@section('body')
    {{--  Write Body Code Here  --}}

    <!-- Title of Page Section -->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 bg-title-workshop-div">
                    <div class="title-page-div">
                        <p class="page-workshop-title">
                            ورشات الحواس
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
                    <p class="text-workshop-page">
                        العديد من الورشات والفعاليات التربوية التثقيفية لشتى الشرائح الطلابية منها بمواضيع الحذر على الطرق وأخرى بمواضيع السلامة والصحة او بمواضيع توعوية للتسامح ونبذ العنف. ورشات عمل وفعاليات تربوية لشتى الاجيال في المدارس, الابتدائية, الاعدادية والثانوية
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Card Section -->
    <section class="mt-3">
        <div class="container">
            <div class="row">
              @component('common.workshopImage')
                  @slot('image') workshop1.png @endslot
              @endcomponent
              @component('common.workshopImage')
                  @slot('image') workshop2.png @endslot
              @endcomponent
              @component('common.workshopImage')
                  @slot('image') workshop3.png @endslot
              @endcomponent
              @component('common.workshopImage')
                  @slot('image') workshop4.png @endslot
              @endcomponent
              @component('common.workshopImage')
                  @slot('image') workshop5.png @endslot
              @endcomponent
              @component('common.workshopImage')
                  @slot('image') workshop6.png @endslot
              @endcomponent
            </div>

        </div>
    </section>
@endsection


@section('script')
    {{--  Write Js Script Code Here  --}}
    <script src="{{asset('assets/js/components/library.js')}}"></script>

@endsection

