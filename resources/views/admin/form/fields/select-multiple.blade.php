@php
$values = isset($model) ? $relationshipsModel->{$field->name}->pluck($field->saveField)->toArray() : null;
if (old($field->name)) {
$values = old($field->name);
}
@endphp
<div class="form-group">
    @include('admin.form.fields.components.label')
    <select name="{{ $field->name }}[]" multiple type="select" id="{{ $field->id ? $field->id : $field->name }}"
        class="form-control select2">
        @foreach ($field->options as $option)
            <option {{ isset($model) && in_array($option[$field->saveField], $values) ? 'selected' : '' }}
                value="{{ $option[$field->saveField] }}">{{ $option[$field->displayField] }}</option>
        @endforeach
    </select>
    @error($field->name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
