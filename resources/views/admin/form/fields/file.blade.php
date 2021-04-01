<div class="form-group">
    @include('admin.form.fields.components.label')
    <input name="{{ $field->name }}" type="file" id="{{ $field->id ? $field->id : $field->name }}"
        class="form-control" {{ $field->required ? 'required' : '' }} @if (isset($model)) value="{{ old($field->name, $model->{$field->name}) }}"
@elseif (isset($field->default))
        value="{{ $field->default }}"
@else
        value="{{ old($field->name) }}" @endif />
    @error($field->name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>