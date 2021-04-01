<div class="form-group">
    @include('admin.form.fields.components.label')
    <textarea name="{{ $field->name }}" id="{{ $field->id ? $field->id : $field->name }}"
        {{ $field->required ? 'required' : '' }} class="form-control" cols="30" rows="10">@if (isset($model)){{ old($field->name, $model->{$field->name}) }}@elseif (isset($field->default)){{ $field->default }}@else{{ old($field->name) }} @endif
    </textarea>
    @error($field->name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
