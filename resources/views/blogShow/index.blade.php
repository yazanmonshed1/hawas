@extends('layouts.app')

@section('meta_keyword','index page meta keyword')
@section('meta_description','Your in index page meta description')

@section('title_Page','index page')

@section('style')
    {{--  Add Css File Here for this page  --}}
    <link rel="stylesheet" href="{{asset('assets/css/components/blogShow.css')}}">
@endsection

@section('fonts')
    {{--  Add Fonts Url Here for this page  --}}

@endsection


@section('body')
    {{--  Write Body Code Here  --}}

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
            <div class="row">
                <div class="col-md-6">
                    <img src="{{asset('assets/images/cute-little-girl-.png')}}"
                    class="w-100">
                </div>
                <div class="col-md-6 text-md-right text-center mt-3 pr-md-0">
                    <div class="d-inline-block ml-4">
                      <span class="">
                          <i class="far fa-calendar calender-icon"></i>
                      </span>
                        <bdi class="blog-time pr-1">
                            الخميس 7، يونيو، 2020
                        </bdi>
                    </div>
                    <div class="d-inline-block">
                        <span>
                            <i class="far fa-clock clock-icon"></i>
                        </span>
                        <span class="blog-time pr-1">
                            12:30
                        </span>
                    </div>
                    <div class="mt-3">
                        <p class="title-blog mb-2">
                            سلوك وتصرفات الآباء والأمهات
                        </p>
                    <p class="text-blog">
                        سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي جبارين مدير عام مؤسسة حواس إن التصرفات والسلوكيات التي يقوم بها الآباء والأمهات أمام أبنائهم ما هي إلا تذويت وعمق في سلوك أبنائهم في الحاضر وفي المستقبل, كانت هذه السلوكيات حكيمة ومسؤولة أو على العكس عشوائية وغير مسؤولة سواء في البيت أو في الشارع أو أثناء
                    </p>
                    </div>
                </div>
                <div class="col-12 text-md-right text-center mt-3">
                    <p class="text-blog">
                        سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي جبارين مدير عام مؤسسة حواس إن التصرفات والسلوكيات التي يقوم بها الآباء والأمهات أمام أبنائهم ما هي إلا تذويت وعمق في سلوك أبنائهم في الحاضر وفي المستقبل, كانت هذه السلوكيات حكيمة ومسؤولة أو على العكس عشوائية وغير مسؤولة سواء في البيت أو في الشارع أو أثناء
                    </p>
                    <p class="text-blog">
                        سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي جبارين مدير عام مؤسسة حواس إن التصرفات والسلوكيات التي يقوم بها الآباء والأمهات أمام أبنائهم ما هي إلا تذويت وعمق في سلوك أبنائهم في الحاضر وفي المستقبل, كانت هذه السلوكيات حكيمة ومسؤولة أو على العكس عشوائية وغير مسؤولة سواء في البيت أو في الشارع أو أثناء
                        سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي جبارين مدير عام مؤسسة حواس إن التصرفات والسلوكيات التي يقوم بها الآباء والأمهات أمام أبنائهم ما هي إلا تذويت وعمق في سلوك أبنائهم في الحاضر وفي المستقبل, كانت هذه السلوكيات حكيمة ومسؤولة أو على العكس عشوائية وغير مسؤولة سواء في البيت أو في الشارع أو أثناء
                        سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي جبارين مدير عام مؤسسة حواس إن التصرفات والسلوكيات التي يقوم بها الآباء والأمهات أمام أبنائهم ما هي إلا تذويت وعمق في سلوك أبنائهم في الحاضر وفي المستقبل, كانت هذه السلوكيات حكيمة ومسؤولة أو على العكس عشوائية وغير مسؤولة سواء في البيت أو في الشارع أو أثناء
                        سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي جبارين مدير عام مؤسسة حواس إن التصرفات والسلوكيات التي يقوم بها الآباء والأمهات أمام أبنائهم ما هي إلا تذويت وعمق في سلوك أبنائهم في الحاضر وفي المستقبل, كانت هذه السلوكيات حكيمة ومسؤولة أو على العكس عشوائية وغير مسؤولة سواء في البيت أو في الشارع أو أثناء
                    </p>
                    <p class="text-blog">
                        سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي جبارين مدير عام مؤسسة حواس إن التصرفات والسلوكيات التي يقوم بها الآباء والأمهات أمام أبنائهم ما هي إلا تذويت وعمق في سلوك أبنائهم في الحاضر وفي المستقبل, كانت هذه السلوكيات حكيمة ومسؤولة أو على العكس عشوائية وغير مسؤولة سواء في البيت أو في الشارع أو أثناء
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src="{{asset('assets/images/brothers.png')}}"
                    class="w-100">
                </div>
                <div class="col-md-6 text-md-right text-center mt-md-0 mt-4 pr-md-0">
                    <p class="text-blog">
                        سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي جبارين مدير عام مؤسسة حواس إن التصرفات والسلوكيات التي يقوم بها الآباء والأمهات أمام أبنائهم ما هي إلا تذويت وعمق في سلوك أبنائهم في الحاضر وفي المستقبل, كانت هذه السلوكيات حكيمة ومسؤولة أو على العكس عشوائية وغير مسؤولة سواء في البيت أو في الشارع أو أثناء
                    </p>
                    <p class="text-blog">
                        سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي جبارين مدير عام مؤسسة حواس إن التصرفات والسلوكيات التي يقوم بها الآباء والأمهات أمام أبنائهم ما هي إلا تذويت وعمق في
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- More Blog Section -->
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-md-right text-center">
                    <p class="m-0 title-more">
                        قد يهمك أيضاَ
                    </p>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-3 mt-md-0 mt-3">
                            <a href="">
                                <div class="card blog-card-style">
                                    <img class="card-img-top"
                                         src="{{asset('assets/images/reading.png')}}"
                                         alt="Card image cap">
                                    <div class="card-body p-1 text-md-right text-center">
                                        <p class="blog-card-title mt-md-1 mt-3 mb-2">سلوك وتصرفات الآباء </p>
                                        <p class="blog-card-text mb-2">سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي</p>
                                        <div class="btn moreButton">
                                            <span class="moreText">المزيد</span>
                                            <span class="moreLeftArrow">
                        <i class="fas fa-long-arrow-alt-left"></i>
                                </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 mt-md-0 mt-4">
                            <a href="">
                                <div class="card blog-card-style">
                                    <img class="card-img-top"
                                         src="{{asset('assets/images/cute-girl.png')}}"
                                         alt="Card image cap">
                                    <div class="card-body p-1 text-md-right text-center">
                                        <p class="blog-card-title mt-md-1 mt-3 mb-2">سلوك وتصرفات الآباء </p>
                                        <p class="blog-card-text mb-2">سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي</p>
                                        <div class="btn moreButton">
                                            <span class="moreText">المزيد</span>
                                            <span class="moreLeftArrow">
                        <i class="fas fa-long-arrow-alt-left"></i>
                                </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 mt-md-0 mt-4">
                            <a href="">
                                <div class="card blog-card-style">
                                    <img class="card-img-top"
                                         src="{{asset('assets/images/father-son.png')}}"
                                         alt="Card image cap">
                                    <div class="card-body p-1 text-md-right text-center">
                                        <p class="blog-card-title mt-md-1 mt-3 mb-2">سلوك وتصرفات الآباء </p>
                                        <p class="blog-card-text mb-2">سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي</p>
                                        <div class="btn moreButton">
                                            <span class="moreText">المزيد</span>
                                            <span class="moreLeftArrow">
                        <i class="fas fa-long-arrow-alt-left"></i>
                                </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 mt-md-0 mt-4">
                            <a href="">
                                <div class="card blog-card-style">
                                    <img class="card-img-top"
                                         src="{{asset('assets/images/kids-box.png')}}"
                                         alt="Card image cap">
                                    <div class="card-body p-1 text-md-right text-center">
                                        <p class="blog-card-title mt-md-1 mt-3 mb-2">سلوك وتصرفات الآباء </p>
                                        <p class="blog-card-text mb-2">سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي</p>
                                        <div class="btn moreButton">
                                            <span class="moreText">المزيد</span>
                                            <span class="moreLeftArrow">
                        <i class="fas fa-long-arrow-alt-left"></i>
                                </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    {{--  Write Js Script Code Here  --}}
@endsection
