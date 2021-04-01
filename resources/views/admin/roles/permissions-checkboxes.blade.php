<div class="form-group">
    <label for="">{{ __('Permissions') }}</label>
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
                            {{ isset($selectedPermissions) && in_array($permission->id, $selectedPermissions) ? 'checked' : '' }} type="checkbox"
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
