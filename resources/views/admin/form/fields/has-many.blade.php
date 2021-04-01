@php

$value = isset($model) ? $relationshipsModel->{$field->name}->pluck($field->saveField) : null;
if (isset($model)) {
    $value = $relationshipsModel->{$field->name}->pluck($field->saveField)->toArray();
} else {
    $value = null;
}
if (isset($field->value)) {
    $value = $field->value;
}
@endphp
<div class="form-group">
    @include('admin.form.fields.components.label')
    <select name="{{ $field->name }}[]" id="{{ $field->id ? $field->id : $field->name }}"
        class="form-control select2 hasMany" {{ $field->required ? 'required' : '' }} multiple="multiple">
        @foreach ($field->list as $item)
            <option {{ isset($model) && in_array($item[$field->saveField], $value) ? 'selected' : '' }}
                value="{{ $item[$field->saveField] }}">{{ $item[$field->displayField] }}</option>
        @endforeach
    </select>
</div>
