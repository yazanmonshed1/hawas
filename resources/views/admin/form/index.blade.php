<form callback="{{ $form->callback ? $form->callback : '' }}" action="{{ $action }}" method="POST"
    id="{{ $form->id ? $form->id : '' }}"
    class="{{ $form->classes }} {{ $form->ajax ? 'submit_form_via_ajax' : '' }}" {{ $form->ajax }} novalidate>
    @csrf
    @isset($model)
        @method('PUT')
    @endisset
    @foreach ($form->fields as $field)
        @if ($field->type == 'extra-field')
            {!! $field->view !!}
        @else
            @include('admin.form.fields.' . $field->type, ['field' => $field])
        @endif
    @endforeach
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ __('admin.save') }}</button>
    </div>
</form>
