@php
$value = isset($model) ? $relationshipsModel->{$field->name} : null;
if (isset($field->value)) {
    $value = $field->value;
}
@endphp
<div class="form-group">
    @include('admin.form.fields.components.label')
    <select name="{{ $field->name }}" id="{{ $field->id ? $field->id : $field->name }}"
        class="form-control select2 belongs-to">
        @foreach ($field->list as $item)
            <option {{ $value && $value == $item[$field->saveField] ? 'selected' : '' }}
                value="{{ $item[$field->saveField] }}">{{ $item[$field->displayField] }}</option>
        @endforeach
    </select>
    @error($field->name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
