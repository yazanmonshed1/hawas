<div class="form-group">
    @include('admin.form.fields.components.label')
    <input name="{{ $field->name }}" type="text" id="{{ $field->id ? $field->id : $field->name }}"
        placeholder="{{ $field->placeholder }}" class="form-control" {{ $field->required ? 'required' : '' }}
        {{ $field->pattern ? 'pattern="' . $field->pattern . '"' : '' }}
        {{ $field->min ? 'min="' . $field->min . '"' : '' }} {{ $field->max ? 'max="' . $field->max . '"' : '' }}
        {{ $field->format ? 'format="' . $field->format . '"' : '' }} @if ($model)
    value="{{ old($field->name, $model->{$field->name}) }}"
@else
    value="{{ old($field->name) }}"
    @endif />
</div>
