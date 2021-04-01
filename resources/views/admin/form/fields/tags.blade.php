@php
$values = isset($model) ? $relationshipsModel->{$field->name}->pluck($field->saveField)->toArray() : null;
if (old($field->name)) {
$values = old($field->name);
}
@endphp
<div class="form-group">
    @include('admin.form.fields.components.label')
    <select parent-id="{{$field->parentId ? $field->parentId : ''}}" display-field="{{$field->displayField}}" table-name="{{$field->tableName}}" name="{{ $field->name }}[]" id="{{ $field->id ? $field->id : $field->name }}"
        class="form-control select2 tags" api="{{$field->addApi}}" max="{{$field->max}}" min="{{$field->min}}" {{ $field->required ? 'required' : '' }} multiple="multiple">
        @foreach ($field->list as $item)
            <option {{ isset($model) && in_array($item[$field->saveField], $values) ? 'selected' : '' }}
                value="{{ $item[$field->saveField] }}">{{ $item[$field->displayField] }}</option>
        @endforeach
    </select>
    @error($field->name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
