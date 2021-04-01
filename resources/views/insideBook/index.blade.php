@extends('layouts.app')

@section('meta_keyword','index page meta keyword')
@section('meta_description','Your in index page meta description')

@section('title_Page','index page')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/components/insideBook.css')}}">
    {{--  Add Css File Here for this page  --}}
@endsection

@section('fonts')
    {{--  Add Fonts Url Here for this page  --}}

@endsection


@section('body')
    {{--  Write Body Code Here  --}}

    <!-- Title Page Section-->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 bg-title-div">
                    <div class="title-div">
                        <p class="book-title">
                            زعتر الحكيم في الطريق
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Book Images Section -->
    <section class="mt-3 mt-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 text-center">
                    <img src="{{asset('assets/images/zaatar-back.png')}}"
                         class="insideBook-img">
                    <img src="{{asset('assets/images/zaatar.png')}}"
                    class="insideBook-img">
                </div>
            </div>
        </div>
    </section>



    <!-- Book Parts Section -->
    <section class="mt-md-5 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12 text-md-right text-center">
                    <p class="part-title">
                        الجزء الأول
                    </p>
                </div>

                <div class="col-12">
                    <div id="accordion">
                        <div class="card card-collapse-style mt-3" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="card-header header-collapse-style text-md-right text-center" id="headingOne">
                                <h5 class="card-text-collapse mb-0">
                                  <span class="title-collapse">  عينة من مواضيع ومضامين </span>
                                    <span class="collapse-button pl-2">
                                    <i class="collapse_icon fas fa-caret-down collapse-arrow-style"></i>
                                    </span>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapseCardEvent collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="row cardText card-body p-5 text-md-right text-center">
                                    <div class="col-md-4 mt-3 image-book">
                                        <div class="page-opacity">
                                        </div>
                                        <div class="zoom-div">
                                            <a href="#lightbox-target-page" class="lightbox lightbox-toggle text-center">
                                                <div>
                                                <i class="fas fa-search-plus zoom-icon"></i>
                                                </div>
                                                <div>
                                                    <p class="zoom-text">تكبير الصورة</p>
                                                </div>
                                            </a>
                                        </div>

                                    <img src="{{asset('assets/images/onePage.png')}}"
                                    class="book-pages-img">
                                    </div>
                                    <div class="col-md-4 mt-3 image-book">
                                        <div class="page-opacity">

                                        </div>
                                        <div class="zoom-div">
                                            <a href="#lightbox-target-page" class="lightbox lightbox-toggle text-center">
                                            <div>
                                                <i class="fas fa-search-plus zoom-icon"></i>
                                            </div>
                                                <div>
                                                <p class="zoom-text">تكبير الصورة</p>
                                            </div>
                                            </a>
                                        </div>

                                    <img src="{{asset('assets/images/onePage.png')}}"
                                    class="book-pages-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-collapse-style mt-3" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <div class="card-header header-collapse-style text-md-right text-center" id="headingOne">
                                <h5 class="card-text-collapse mb-0">
                                    <span class="title-collapse">  الاغاني والاناشيد في الحذر على الطرق جزء من وسائل تدريسية متعددة </span>
                                     <span class="collapse-button pl-2">
                                    <i class="collapse_icon  fas fa-caret-down collapse-arrow-style"></i>
                                    </span>
                                </h5>
                            </div>

                            <div id="collapseTwo" class="collapseCardEvent collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="row cardText card-body p-5 text-md-right text-center">
                                    <div class="col-md-4 mt-3 image-book">
                                        <div class="page-opacity">

                                        </div>
                                        <div class="zoom-div">
                                            <a href="#lightbox-target-page" class="lightbox lightbox-toggle text-center">
                                                <div>
                                                    <i class="fas fa-search-plus zoom-icon"></i>
                                                </div>
                                                <div>
                                                    <p class="zoom-text">تكبير الصورة</p>
                                                </div>
                                            </a>
                                        </div>

                                        <img src="{{asset('assets/images/onePage.png')}}"
                                             class="book-pages-img">
                                    </div>
                                    <div class="col-md-4 mt-3 image-book">
                                        <div class="page-opacity">

                                        </div>
                                        <div class="zoom-div">
                                            <a href="#lightbox-target-page" class="lightbox lightbox-toggle text-center">
                                                <div>
                                                    <i class="fas fa-search-plus zoom-icon"></i>
                                                </div>
                                                <div>
                                                    <p class="zoom-text">تكبير الصورة</p>
                                                </div>
                                            </a>
                                        </div>

                                        <img src="{{asset('assets/images/onePage.png')}}"
                                             class="book-pages-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-collapse-style mt-3" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            <div class="card-header header-collapse-style text-md-right text-center" id="headingOne">
                                <h5 class="card-text-collapse mb-0">
                                    <span class="title-collapse">  الرسومات والاسئلة التحليلية جزء من وسائل تدريسية متعددة </span>
                                    <span class="collapse-button pl-2">
                                    <i class="collapse_icon fas fa-caret-down collapse-arrow-style"></i>
                                    </span>
                                </h5>
                            </div>

                            <div id="collapseThree" class="collapseCardEvent collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="row cardText card-body p-5 text-md-right text-center">
                                    <div class="col-md-4 mt-3 image-book">
                                        <div class="page-opacity">

                                        </div>
                                        <div class="zoom-div">
                                            <a href="#lightbox-target-page" class="lightbox lightbox-toggle text-center">
                                                <div>
                                                    <i class="fas fa-search-plus zoom-icon"></i>
                                                </div>
                                                <div>
                                                    <p class="zoom-text">تكبير الصورة</p>
                                                </div>
                                            </a>
                                        </div>

                                        <img src="{{asset('assets/images/onePage.png')}}"
                                             class="book-pages-img"  {{--id="img01"--}}>
                                    </div>
                                    <div class="col-md-4 mt-3 image-book">
                                        <div class="page-opacity">

                                        </div>
                                        <div class="zoom-div">
                                            <a href="#lightbox-target-page" class="lightbox lightbox-toggle text-center">
                                                <div>
                                                    <i class="fas fa-search-plus zoom-icon"></i>
                                                </div>
                                                <div>
                                                    <p class="zoom-text">تكبير الصورة</p>
                                                </div>
                                            </a>
                                        </div>

                                        <img src="{{asset('assets/images/onePage.png')}}"
                                             class="book-pages-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-md-right text-center">
                    <p class="part-title">
                        الجزء الثاني
                    </p>
                </div>

                <div class="col-12">
                    <div id="accordion">
                        <div class="card card-collapse-style mt-3" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                            <div class="card-header header-collapse-style text-md-right text-center" id="headingFour">
                                <h5 class="card-text-collapse mb-0">
                                    <span class="title-collapse">عينة من مواضيع ومضامين التعليم</span>
                                    <span class="collapse-button pl-2">
                                    <i class="collapse_icon fas fa-caret-down collapse-arrow-style"></i>
                                    </span>
                                </h5>
                            </div>

                            <div id="collapseFour" class="collapseCardEvent collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="row cardText card-body p-5 text-md-right text-center">
                                    <div class="col-md-4 image-book">
                                        <div class="page-opacity">

                                        </div>
                                        <div class="zoom-div">
                                            <a href="#lightbox-target-page" class="lightbox lightbox-toggle text-center">
                                                <div>
                                                    <i class="fas fa-search-plus zoom-icon"></i>
                                                </div>
                                                <div>
                                                    <p class="zoom-text">تكبير الصورة</p>
                                                </div>
                                            </a>
                                        </div>

                                        <img src="{{asset('assets/images/onePage.png')}}"
                                             class="book-pages-img"  {{--id="img01"--}}>
                                    </div>
                                    <div class="col-md-4 image-book">
                                        <div class="page-opacity">

                                        </div>
                                        <div class="zoom-div">
                                            <a href="#lightbox-target-page" class="lightbox lightbox-toggle text-center">
                                                <div>
                                                    <i class="fas fa-search-plus zoom-icon"></i>
                                                </div>
                                                <div>
                                                    <p class="zoom-text">تكبير الصورة</p>
                                                </div>
                                            </a>
                                        </div>

                                        <img src="{{asset('assets/images/onePage.png')}}"
                                             class="book-pages-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-collapse-style mt-3" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                            <div class="card-header header-collapse-style text-md-right text-center" id="headingFive">
                                <h5 class="card-text-collapse mb-0">
                                    <span class="title-collapse">  الاغاني والاناشيد في الحذر على الطرق جزء من وسائل تدريسية متعددة </span>
                                    <span class="collapse-button pl-2">
                                    <i class="collapse_icon fas fa-caret-down collapse-arrow-style"></i>
                                    </span>
                                </h5>
                            </div>

                            <div id="collapseFive" class="collapseCardEvent collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                <div class="row cardText card-body p-5 text-md-right text-center">
                                    <div class="col-md-4 image-book">
                                        <div class="page-opacity">

                                        </div>
                                        <div class="zoom-div">
                                            <a href="#lightbox-target-page" class="lightbox lightbox-toggle text-center">
                                                <div>
                                                    <i class="fas fa-search-plus zoom-icon"></i>
                                                </div>
                                                <div>
                                                    <p class="zoom-text">تكبير الصورة</p>
                                                </div>
                                            </a>
                                        </div>

                                        <img src="{{asset('assets/images/onePage.png')}}"
                                             class="book-pages-img"  {{--id="img01"--}}>
                                    </div>
                                    <div class="col-md-4 image-book">
                                        <div class="page-opacity">

                                        </div>
                                        <div class="zoom-div">
                                            <a href="#lightbox-target-page" class="lightbox lightbox-toggle text-center">
                                                <div>
                                                    <i class="fas fa-search-plus zoom-icon"></i>
                                                </div>
                                                <div>
                                                    <p class="zoom-text">تكبير الصورة</p>
                                                </div>
                                            </a>
                                        </div>

                                        <img src="{{asset('assets/images/onePage.png')}}"
                                             class="book-pages-img">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>




    <div class="lightbox-target" id="lightbox-target-page">
        <img src="{{asset('assets/images/onePage.png')}}"
        class="image-in-zoom">
        <a class="lightbox-close" href="#"></a>
    </div>

@endsection


@section('script')
    {{--  Write Js Script Code Here  --}}
    <script src="{{asset('assets/js/components/insideBook.js')}}"></script>
@endsection
