<div class="form-group">
    @include('admin.form.fields.components.label')
    <input name="{{ $field->name }}" type="number" id="{{ $field->id ? $field->id : $field->name }}"
        placeholder="{{ $field->placeholder }}" class="form-control" {{ $field->required ? 'required' : '' }}
        {{ $field->pattern ? 'pattern="' . $field->pattern . '"' : '' }}
        {{ $field->min ? 'min="' . $field->min . '"' : '' }} {{ $field->max ? 'max="' . $field->max . '"' : '' }}
        @if (isset($model))
    value="{{ old($field->name, $model->{$field->name}) }}"
@else
    value="{{ old($field->name) }}"
    @endif />
    @error($field->name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
