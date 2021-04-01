<div class="form-group">
    @include('admin.form.fields.components.label')
    <input name="{{ $field->name }}" type="{{ $field->text_type ? $field->text_type : 'text' }}"
        id="{{ $field->id ? $field->id : $field->name }}" placeholder="{{ $field->placeholder }}"
        class="form-control" {{ $field->required ? 'required' : '' }}
        {{ $field->pattern ? 'pattern="' . $field->pattern . '"' : '' }} 
        @if ($field->text_type != 'password')  
            @if (isset($model))
                @if (isset($field->default))
                    value="{{ $field->default }}"
                @else
                    value="{{ old($field->name, $model->{$field->name}) }}"
                @endif
            @endif
        @endif
    />
    @error($field->name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
