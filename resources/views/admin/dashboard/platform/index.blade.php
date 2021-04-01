@extends('admin.layouts.dashboard')

@section('body')

    <input type="hidden" id="env" value="{{getenv('APP_ENV')}}">

    <input id="token" type="hidden" value="{{ $token }}">
    <input id="book_id" type="hidden" value="{{ $bookId }}">

    <div id="app"></div>

    <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>


    <script src="{{ asset('admin/platform/dist/main.js') }}"></script>

@endsection
