@extends('admin.layouts.dashboard')

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $name['plural'] }}</h4>
                <a href="{{ route('admin.' . $routeSlug . '.create') }}" class="text-success">
                    <i class="fa fa-plus px-2"></i>
                    <span>{{ __('Add') . ' ' . $name['singular'] }}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- <h4 class="card-title">Default Datatable</h4>
                    <p class="card-title-desc">DataTables has most features enabled by
                        default, so all you need to do to use it with your own tables is to call
                        the construction function: <code>$().DataTable();</code>.
                    </p> --}}
                    {!! $grid !!}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

