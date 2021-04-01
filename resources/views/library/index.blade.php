@extends('layouts.app')






@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/library.css') }}">
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
                <div class="col-12 bg-title-div">
                    <div class="title-div">
                        <p class="page-title">
                            مكتبة حواس
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Tab Menu Books Section -->
    <section class="mt-3">
        <div class="container">
            <ul class="row nav nav-tabs border_nav justify-content-md-center">
                <li class="col-md-2 col-11 book-type {{ $type == 'digital' ? 'book-type-active active' : '' }}">
                    <a data-toggle="tab" href="#menu1" class="tab_boxes">
                        <div class="card card_style_boxes {{-- card_style_boxes_active --}}">
                            <div class="card-body blue-border-card-body p-3">
                                <p class="m-0 blue_box_title text-center"> كتب رقمية
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="col-md-2 col-11 book-type {{ $type == 'text' ? 'book-type-active active' : '' }} mt-3 mt-md-0">
                    <a data-toggle="tab" href="#menu2" class="tab_boxes">
                        <div class="card card_style_boxes {{-- card_style_boxes_active --}}">
                            <div class="card-body orange-border-card-body p-3">
                                <p class="m-0 orange_box_title text-center"> كتب ورقية
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="row mt-md-5 mt-3 mb-3">
                <div class="col-12 tab-content">
                    <div id="menu1" class="tab-pane fade in {{ $type == 'digital' ? 'active show' : '' }}">
                        <div class="row">
                            @foreach ($digitalBooks as $book)
                                @include('common.videoCard', ['book' => $book])
                            @endforeach
                        </div>
                    </div>
                    <div id="menu2" class="tab-pane fade {{ $type == 'text' ? 'active show' : '' }}">
                        <div class="row">
                            @foreach ($textBooks as $book)
                                @include('common.textBook', ['book' => $book])
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- Login Modal -->
    <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content loginModal-style">
                <div class="modal-header remove-border">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="fas fa-times close-icon"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body  pr-5 pl-5 pb-5 pt-2 remove-border">
                    <div class="row justify-content-center test-modal1 m-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/login-hand.png') }}" class="login-img">
                        </div>
                        <div class="col-12 pt-3 text-center">
                            <p class="title-loginModal">يجب تسجيل الدخول اولاً</p>
                            <p class="text-loginModal">لتتمكن من مشاهدة الكتب الرقمية والتفاعل معها يجب ان تقوم بتسجيل
                                الدخول اولاً للوصول الى منصة حواس التعليمية</p>
                            <div class="btn moreButton">
                                <a id="removeAndShowLogin" href="#" class="login-button" data-toggle="modal"
                                    data-target="#sure-menuModal">
                                    <span class="login-text-button">تسجيل الدخول</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    {{-- Write Js Script Code Here --}}
    <script src="{{ asset('assets/js/components/library.js') }}"></script>
    <script>
        $(document).on('click', '#removeAndShowLogin', function() {
            $('#LoginModal').modal('hide')
        })

        $('#LoginModal').on('show.bs.modal', function(e) {
            // do something...
            body_styles = $('body').attr('style');
            $('body').attr('style', '');
            $('html').attr('style', body_styles);
        })

    </script>
@endsection
