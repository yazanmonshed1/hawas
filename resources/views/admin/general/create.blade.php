@extends('admin.layouts.dashboard')

@section('body')

    <h1>Create new Example</h1>

    {!! $form !!}

@endsection
@section('script')
    @include('admin.scripts.add-edit-script')
@endsection
