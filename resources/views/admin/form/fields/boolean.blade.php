<div class="form-group">
    <label for="{{ $field->id ? $field->id : $field->name }}">{{ $field->label }}</label>
    <div class="boolean-field"
        style="width: 80px; height: 40px; border-radius: 25px; background-color: #3452e1; position: relative">
        <div class="boolean-button"
            style="width: 30px; height: 30px; border-radius: 50%; top: 5px; left:5px; position: absolute; background-color: white">
        </div>
    </div>
</div>
