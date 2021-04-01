@extends('layouts.app')

@section('meta_keyword', 'index page meta keyword')
@section('meta_description', 'Your in index page meta description')

@section('title_Page', 'index page')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/platform/profile.css') }}">
    {{-- Add Css File Here for this page --}}
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection


@section('body')
    {{-- Write Body Code Here --}}

    <!-- Background Section -->
    <section class="background-profile-section"></section>


    <!-- Profile Info Section -->
    <section class="profile-info-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mt-md-0 mt-3">
                    <div class="card card-profile-style">
                        <div class="card-title pt-2 mb-0 text-center">
                            <div class="row m-0 float-md-left">
                                <div class="col-md-12 text-md-left text-center">
                                    <div class="back-book-profile-button-div">
                                        <a href="{{ route('my-books') }}" class="back-book-profile-button">
                                            <span class="ml-1">
                                                <img src="{{ asset('assets/images/platform/right-arrow.png') }}"
                                                    class="arrow-in-profile-button">
                                            </span>
                                            <span class="ml-1">
                                                <img src="{{ asset('assets/images/platform/study-book.png') }}"
                                                    class="image-book-in-profile-button">
                                            </span>
                                            <span> العودة الى كتبي </span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row m-0 justify-content-center">
                                <div class="col-12 text-md-right text-center">
                                    <div>
                                        <span class="ml-2 pt-3">
                                            <img src="{{ asset('assets/images/platform/man.png') }}"
                                                class="profile-stu-user">
                                        </span>
                                        <span class="profile-title">
                                            ملفي الشخصي:
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-10 mt-md-5 mt-3 text-center">
                                    <div class="image-border m-auto">
                                        <img src="{{ asset('storage/' . $user->avatar) }}" class="profile-stu-img" id="profile-user-image">
                                    </div>
                                </div>
                                <form id="change-user-image-form"
                                    action="{{ route('profile.update-image') }}"
                                    class="col-md-6 col-5 mt-2 text-md-left text-center">
                                    <div class="upload-div">
                                        <input name="user_image" type="file" id="upload-img" name="upload-img"
                                            class="upload-input">
                                        <a href="" class="change-img d-block" id="change-user-image" style="padding-top: 13px">
                                            تغيير الصورة
                                        </a>
                                    </div>
                                </form>
                                <div class="col-md-6 col-5 mt-2 pr-0 text-md-right text-center">
                                    <a href="" id="delete-image" class="delete-img">
                                        <span class="border-between pl-2">

                                        </span>
                                        حذف الصورة

                                    </a>
                                </div>
                            </div>
                            <form action="{{ route('profile.save') }}">
                                <div class="row m-0">
                                    <div class="col-md-4 text-right mb-3">
                                        <label class="profile-label m-0 pr-2">اسم الطالب:</label>
                                        <input name="name" type="text" class="input-profile font-weight-bold mt-1"
                                            value="{{ old('username', $user->name) }}"
                                            style="color: #777878; font-size: 14px">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 text-right mb-3">
                                        <label class="profile-label m-0 pr-2">اسم المستخدم:</label>
                                        <input type="text" class="input-profile mt-1" placeholder="{{ $user->username }}"
                                            disabled>
                                    </div>
                                    <div class="col-md-4 text-right mb-3">
                                        <label class="profile-label m-0 pr-2">رقم الهاتف:</label>
                                        <input type="number" class="input-profile mt-1"
                                            placeholder="{{ $user->phone_no }}" disabled>
                                    </div>
                                    <div class="col-md-4 text-right mb-3">
                                        <label class="profile-label m-0 pr-2">البريد الالكتروني:</label>
                                        <input type="email" class="input-profile mt-1" placeholder="{{ $user->email }}" disabled>
                                    </div>
                                    <div class="col-md-4 text-right mb-3 position-relative">
                                        <label for="class" class="profile-label m-0 pr-2">الصف:</label>
                                        <input type="text" class="input-profile mt-1" placeholder="{{ $user->grade->name }}" disabled>
                                        <div class="select-arrow">
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right mb-3">
                                        <label class="profile-label m-0 pr-2">المدرسة:</label>
                                        <input type="name" class="input-profile"
                                            placeholder="{{ $user->grade->school->name }}" disabled>
                                    </div>

                                </div>
                                {{-- <div class="row m-0 mt-md-5 mt-3">
                                    <div class="col-12 text-center">
                                        <p class="change-text">
                                            تغيير كلمة المرور
                                        </p>
                                    </div>
                                    <div class="col-12 change-border-div">
                                        <div class="row justify-content-center m-0 mt-3 pb-3">
                                            <div class="col-md-4 text-right mb-3">
                                                <label class="profile-label m-0 pr-1">كلمة المرور القديمة:</label>
                                                <input type="password" class="input-profile mt-1" placeholder="************">
                                            </div>
                                            <div class="col-md-4 text-right mb-3">
                                                <label class="profile-label m-0 pr-1">كلمة المرور الجديدة:</label>
                                                <input type="password" class="input-profile mt-1" placeholder="************">
                                            </div>
                                            <div class="col-md-4 text-right mb-3">
                                                <label class="profile-label m-0 pr-1">تأكيد كلمة المرور:</label>
                                                <input type="password" class="input-profile mt-1" placeholder="************">
                                            </div>
                                            <div class="col-md-2 mt-md-4 mt-3">
                                                <button type="submit" class="change-button">
                                                    تغيير
                                                </button>
                                            </div>
                                            <div class="col-md-12 mt-1 text-center">
                                                <span class="forgot-password-text">
                                                    نسيت كلمة المرور؟
                                                </span>
                                                <span>
                                                    <a href="{{ route('contact.index') }}" class="contact-profile">
                                                        تواصل معنا
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row m-0 mt-3 float-left">
                                    <div class="col-md-12 text-md-left text-center pl-md-0">
                                        <button type="submit" class="save-change-button">
                                            حفظ التعديلات
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

@endsection


@section('script')
    {{-- Write Js Script Code Here --}}
    <script src="{{ asset('assets/js/components/platform/profile.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert2@10.js') }}"></script>
@endsection
