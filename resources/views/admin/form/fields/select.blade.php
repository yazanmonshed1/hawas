@php
if (isset($model)) {
    $value = $relationshipsModel->{$field->name};
}
if (old($field->name)) {
    $value = old($field->name);
}
@endphp
<div class="form-group">
    @include('admin.form.fields.components.label')

    <select name="{{ $field->name }}" type="select" id="{{ $field->id ? $field->id : $field->name }}"
        class="form-control select2">
        @foreach ($field->options as $option)
            <option {{ isset($value) && $value == $option[$field->saveField] ? 'selected' : '' }}
                value="{{ $option[$field->saveField] }}">{{ $option[$field->displayField] }}</option>
        @endforeach
    </select>
    @error($field->name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
