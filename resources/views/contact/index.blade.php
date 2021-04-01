@extends('layouts.app')






@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/components/contact.css') }}">
    {{-- Add Css File Here for this page --}}
@endsection

@section('fonts')
    {{-- Add Fonts Url Here for this page --}}

@endsection

@section('contact', 'menu-active')
@section('body')
    {{-- Write Body Code Here --}}

    <section class="mt-3">
        <!-- Title of Page Section -->
        <section class="mt-3 mt-md-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 bg-title-contact-div">
                        <div class="title-contact-div">
                            <p class="page-contact-title">
                                اتصل بنا
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Contact us Section -->
        <section class="mt-3 mt-md-5">
            <div class="container">
                <div class="row m-0">
                    <div class="col-md-4 text-center contact-form-div">
                        <form action="{{ route('contact.store') }}" method="POST"
                            class="row justify-content-center pt-5 pb-5">
                            @csrf
                            <div class="col-12">
                                <p class="send-title">
                                    ارسل لنا رسالة
                                </p>
                            </div>
                            <div class="col-md-8 text-md-right text-center">
                                <label class="contact-label m-0">الاسم</label>
                                <input name="name" type="text" class="input-contact">
                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-8 text-md-right text-center mt-3">
                                <label class="contact-label m-0">البريد الالكتروني</label>
                                <input name="email" type="email" class="input-contact mt-1">
                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-8 text-md-right text-center mt-3">
                                <label class="contact-label m-0">رقم الهاتف</label>
                                <input name="phone_number" type="phone_number" class="input-contact mt-1">
                                @error('phone_number')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-8 text-md-right text- mt-3">
                                <label class="contact-label m-0">الرسالة</label>
                                <textarea class="message-text mt-1" name="message" rows="5"></textarea>
                                @error('message')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-6 col-6 text-center mt-3">
                                <button class="send-button" type="submit">
                                    ارسل
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8 pr-md-0 contact-img-div">
                        <img src="{{ asset('assets/images/contact-us.png') }}" class="w-100">
                    </div>
                </div>
            </div>
        </section>



    @endsection


    @section('script')
        {{-- Write Js Script Code Here --}}

    @endsection
