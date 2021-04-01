@extends('admin.layouts.dashboard')

@section('body')
    @php
    $guardName = old('guard_name') ? old('guard_name') : $role->guard_name
    @endphp

    <h1>Edit Role</h1>

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" value="{{ old('name', $role->name) }}" id="name" class="form-control">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="guard_name"></label>
            <select name="guard_name" id="guard_name" class="form-control">
                <option {{ $guardName == 'admin' ? 'selected' : '' }} value="admin">{{ __('Admin') }}</option>
                <option {{ $guardName == 'web' ? 'selected' : '' }} value="web">{{ __('Normal user') }}</option>
            </select>
        </div>
        <div id="roles-permissions"></div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
    </form>

@endsection
@section('script')
    <script>
        $(document).on('change', '.parent-checkbox', function() {
            $(this).parent().parent().find('.group-checkboxes input').attr('checked', this.checked)
        })

        $(document).ready(function() {
            const guardName = $('#guard_name').val();
            getPermissions(guardName);
        })

        $(document).on('change', '#guard_name', function() {
            getPermissions($(this).val())
        })

        function getPermissions(guardName) {
            let route = "{{ route('admin.roles.permissions', [':guardName', ':id']) }}"

            route = route.replace(':guardName', guardName)
            route = route.replace(':id', "{{ $role->id }}")
            console.log(route)
            $.get(route).done(function(data) {
                $('#roles-permissions').html(data.html)
            })
        }

    </script>
@endsection
