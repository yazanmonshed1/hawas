$(document).on('submit', '.submit_form_via_ajax', function (e) {
    console.log('submit')
    e.preventDefault();
    let form = $(this);
    form.find('.error-form-msg').remove();
    form.ajaxSubmit({
        dataType: "JSON",
        data: {
            json: true
        },
        success: function (res) {
            if (res.message) {
                toastr.success(res.message)
            }
            if (form.hasClass('login')) {
                window.location = '/landing';
            }
        },
        error: function (exception) {
            const errors = exception.responseJSON
            if (errors.message) {
                toastr.error(errors.message)
            }
            $.each(errors.errors, function (key, val) {
                form.find('*[name="' + key + '"]')
                    .addClass('border-error');
                const field = form.find('*[name="' + key + '"]').parent()
                field.append(
                    '<small class="text-danger error-form-msg error_field_' + key +
                    '">' + val +
                    '</small>')
            })
        }
    });
});
$(document).on('change', '.submit_form_via_ajax .border-error', function () {
    $(this).removeClass('border-error')
    $(this).parent().find('.error-form-msg').remove();
})

$('#logout').on('click', function () {
    $(this).parent().submit()
})