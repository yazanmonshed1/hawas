@php
$label = $field->label ? $field->label : $field->name;
@endphp
<label for="{{ $field->id ? $field->id : $field->name }}">{{ __('labels.' . $label) }}</label>
@if ($field->required)
    &nbsp;<label class="text-danger">*</label>
@endif
