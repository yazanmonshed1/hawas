@extends('admin.layouts.dashboard')

@section('body')

    <h1>{{ isset($edit) && $edit ? __('admin.edit') : __('admin.add') }}{{ ' ' . __('models.' . $nameSlug . '.singular') }}
    </h1>

    {!! $form !!}

@endsection
@section('script')
    @include('admin.scripts.add-edit-script')
    @isset($additional_script)
        @include('admin.scripts.' . $additional_script)
    @endisset
@endsection
