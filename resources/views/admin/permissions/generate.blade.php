@extends('admin.layouts.dashboard')

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $name['plural'] }}</h4>
                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="text-success">
                        <i class="fa fa-chevron-left px-2"></i>
                        <span>{{ __('Back') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Permissions generator</h4>
                    <p class="card-title-desc">Generate permissions for tables</p>
                    <form action="{{ route('admin.permissions.generate') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="#tables">{{ __('Generate permissions for') }}</label>
                            @foreach ($tables as $tableName)
                                <div class="form-check">
                                    <input
                                        {{ $allPermissions->has($tableName) && $allPermissions->get($tableName)->count() >= 4 ? 'disabled' : '' }}
                                        class="form-check-input" name="tables[]" type="checkbox" value="{{ $tableName }}"
                                        id="table-{{ $tableName }}">
                                    <label class="form-check-label" for="table-{{ $tableName }}">
                                        {{ $tableName }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@section('script')
    {{-- <script>
        $(document).ready(function() {
            $('#users-datatable').DataTable();
        });

    </script> --}}
@endsection
