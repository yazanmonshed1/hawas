@extends('admin.layouts.dashboard')

@section('body')

    <h1>Edit the Example</h1>

    {!! $form !!}

@endsection
@section('script')
    @include('admin.scripts.add-edit-script')
@endsection
