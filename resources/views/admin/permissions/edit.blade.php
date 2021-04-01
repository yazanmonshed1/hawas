@extends('admin.layouts.dashboard')

@section('body')

    <h1>Edit Role</h1>

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" value="{{ old('name', $role->name) }}" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">{{ __('Permission') }}</label>
            @foreach ($allPermissions as $permissionGroupName => $permissionGroup)
                <div class="form-group mb-5">
                    <div class="form-check">
                        <input class="form-check-input parent-checkbox" type="checkbox"
                            id="permissionGroup-{{ $permissionGroupName }}">
                        <label for="permissionGroup-{{ $permissionGroupName }}"
                            class="form-check-label">{{ $permissionGroupName }}</label>
                    </div>
                    <hr>
                    <div class="group-checkboxes">
                        @foreach ($permissionGroup as $permission)
                            <div class="form-check">
                                <input class="form-check-input" name="permissions[]"
                                    {{ in_array($permission->id, $selectedPermissions) ? 'checked' : '' }} type="checkbox"
                                    value="{{ $permission->id }}" id="permission-{{ $permission->id }}">
                                <label class="form-check-label" for="permission-{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
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

    </script>
@endsection
