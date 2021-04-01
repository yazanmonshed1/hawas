@php
$multiple = $field->multiple ? $field->multiple : false;
$field_id = $field->id ? $field->id : $field->name;

if (isset($model)) {
    if ($multiple) {
        $value = isset($model) ? $relationshipsModel->{$field->name}->pluck($field->saveField)->toArray() : null;
        $media = $relationshipsModel->media;
        $value = json_encode($value);
    } else {
        $singleImage = $value = $relationshipsModel->{$field->name};
    }
    if (old($field->name)) {
        $value = old($field->name);
    }
} else {
    if ($field->default) {
        $value = $field->default;
        $media = \App\NadConsole\Models\Media::find(json_decode($value));
    }
}
if (!$multiple && $field->default) {
    $value = $field->default;
}

@endphp
<div class="form-group file-uploader-container">
    @include('admin.form.fields.components.label')
    @if (isset($media) && $media->count())
        <div class="row">
            @foreach ($media as $item)
                <div id="media-{{ $item->id }}" class="col-md-4 p-3 image-action">
                    <i class="fa fa-trash fa-2x text-danger"></i>
                    <img style="border-radius: 20px" src="{{ asset('storage/' . $item->path) }}" class="w-100">
                </div>
            @endforeach
        </div>
    @endif
    @isset($singleImage)
        <div class="p-3">
            @include('admin.form.fields.components.image_or_video', ['file' => $singleImage])
        </div>
    @endisset
    @if ($field->default)
        @include('admin.form.fields.components.image_or_video', ['file' => $field->default])
    @endif
    <input type="hidden" id="{{ $field_id }}" value="{{ isset($value) && $value ? $value : '' }}"
        name="{{ $field->name }}">

    <div class=" file-uploader dropzone {{ $multiple ? '[]' : '' }}" {{ $multiple ? 'multiple' : '' }}
        save-field=" {{ $field->saveField ? $field->saveField : 'id' }}"
        file-type="{{ isset($field->file_type) ? $field->file_type : 'any' }}" target-field="{{ $field_id }}"
        target-api="{{ isset($field->api) ? $field->api : route('admin.media.store') }}"></div>
    @error($field->name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
