<script src="http://malsup.github.com/jquery.form.js"></script>
<script>
    function makeFileUploader(element) {
        element.dropzone({
            url: "{{ route('admin.media.store') }}",
            maxFiles: 10,
            paramName: 'media',
            parallelUploads: 10,
            uploadMultiple: true,
            params: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            dictDefaultMessage: 'اضغط هنا لرفع الملفات',
            successmultiple: function(file, response) {
                const stored = response.stored

                let targetFieldString = element.attr(
                    'target-field');

                let targetField = $('#' + targetFieldString);

                var value = targetField.val() ? JSON.parse(targetField.val()) : []

                $(response.stored).each(function(idx, item) {
                    value.push(item.id)
                })
                targetField.val(JSON.stringify(value))
            }
        });
    }

    function formErrorsHandler(exception, form) {
        const errors = exception.responseJSON
        if (errors.message) {
            toastr.error(errors.message)
        }
        $.each(errors.errors, function(key, val) {
            form.find('*[name="' + key + '"]')
                .addClass('border-error');
            const field = form.find('*[name="' + key + '"]').parent()
            field.append(
                '<small class="text-danger error-form-msg error_field_' +
                key +
                '">' + val +
                '</small>')
        })
    }

    initUploaders()
    $(document).ready(function() {
        reloadScript()
    })

    // Form ajax submit
    $(document).on('submit', '.submit_form_via_ajax', function(e) {
        e.preventDefault();
        let form = $(this);
        form.find('.error-form-msg').remove();
        let callback = form.attr('callback')
        if (callback && callback != '') {
            window[callback](form)
        } else {
            form.ajaxSubmit({
                dataType: "JSON",
                data: {
                    json: true
                },
                success: function(res) {
                    if (res.message) {
                        toastr.success(res.message)
                        $('#addEditModal').modal('hide')
                        if ($('.dataTable').length >= 1) {
                            $('.dataTable').each(function(idx, el) {
                                $(el).DataTable().draw()
                            })
                        }
                    }
                },
                error: function(exception) {
                    const errors = exception.responseJSON
                    if (errors.message) {
                        toastr.error(errors.message)
                    }
                    $.each(errors.errors, function(key, val) {
                        form.find('*[name="' + key + '"]')
                            .addClass('border-error');
                        const field = form.find('*[name="' + key + '"]').parent()
                        field.append(
                            '<small class="text-danger error-form-msg error_field_' +
                            key +
                            '">' + val +
                            '</small>')
                    })
                }
            });
        }
    });
    $(document).on('change', '.submit_form_via_ajax .border-error', function() {
        $(this).removeClass('border-error')
        $(this).parent().find('.error-form-msg').remove();
    })

    function reloadScript() {

        $('.select2').select2();

        var tagsItems = $('.tags');
        tagsItems.each(function(i, item) {
            let el = $(item)
            let api = el.attr('api')
            let max = el.attr('max')
            let min = el.attr('min')

            let route = "{{ route('admin.get-data.select', [':tableName']) }}"
            route = route.replace(':tableName', el.attr('table-name'))

            route += '?saveField=id&displayField=' + el.attr('display-field')

            let displayField = el.attr('display-field')

            $(el).select2({
                tags: true,
                ajax: {
                    url: route,
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data.result
                        };
                    }
                }
            }).on("change", function(e) {
                if (max && $(this).val().length > max) {
                    $(this).val($(this).val().slice(0, max));
                    $(this).trigger('change')
                }
                var isNew = $(this).find('[data-select2-tag="true"]');
                if (isNew.length && $.inArray(isNew.val(), $(this).val()) !== -1) {
                    $.post(api, {
                        [displayField]: isNew.val(),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    }).done(function(data) {
                        var option = new Option(data.text, data.id);
                        option.selected = true;
                        isNew.remove()
                        $("#tags").append(option)
                    })
                }
            });
        })

        $('.belongs-to').each(function(i, item) {
            let el = $(item)
            el.select2()
        })

        const slugFields = $('.slug')
        slugFields.each(function(idx, el) {
            const element = $(el)
            const listenFieldString = element.attr('target-field')
            const listenField = $(this).parent().parent().find("[name=" + listenFieldString + "]")[0]

            $(listenField).on('keyup', function() {
                element.val(string_to_slug($(this).val()))
            })
        })

    }

    function string_to_slug(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
        var to = "aaaaaeeeeiiiioooouuuunc------";

        for (var i = 0, l = from.length; i < l; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    }

    function initUploaders() {
        const imagesTypes = ['image/png', 'image/jpg', 'image/jpeg']
        const videoTypes = ['video/mp4', 'video/wmv', 'video/avi']
        fileUploaders = $('.file-uploader')

        fileUploaders.each(function(idx, el) {
            const element = $(el)
            const multiple = element.attr('multiple') ? true : false;
            const saveField = element.attr('save-field');
            const targetField = $('#' + element.attr('target-field'))
            if (multiple) {
                var value = targetField.val() ? JSON.parse(targetField.val()) : []
            }

            const defaultValue = $(element).parent().find('input').val()

            element.parent().find('.image-action i').on('click', function() {
                let value = targetField.val() ? JSON.parse(targetField.val()) : []
                const id = $(this).parent().attr('id').split('-')[1]

                if (value.includes(parseInt(id))) {
                    const newValue = value.filter(item => item !== parseInt(id))
                    $(this).parent().remove()
                    targetField.val(JSON.stringify(newValue))
                }
            })

            const file_type = $(element).attr('file-type')

            element.dropzone({
                url: $(element).attr('target-api'),
                maxFiles: multiple ? 10 : 1,
                paramName: 'media',
                parallelUploads: multiple ? 10 : 1,
                uploadMultiple: multiple,
                addRemoveLinks: true,
                params: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    file_type: $(element).attr('file-type')
                },
                dictDefaultMessage: 'اضغط هنا لرفع الملفات',
                init: function() {
                    this.on('addedfile', function(file) {

                        if ($(element).attr('file-type') != 'any') {
                            let targetType = file_type == 'image' ? imagesTypes : videoTypes

                            if (!targetType.includes(file.type)) {
                                this.removeFile(file);
                                toastr.error('الملفات المسموح رفعها : ' + targetType.join(','))
                            }
                        }
                        if (!multiple) {
                            if (this.files.length > 1) {
                                this.removeFile(this.files[0]);
                            }
                        }
                    });

                },
                removedfile: function(file) {
                    file.previewElement.remove();
                    if (multiple) {
                        let value = targetField.val() ? JSON.parse(targetField.val()) : []
                        const id = JSON.parse(file.xhr.response).stored[0].id
                        if (value.includes(parseInt(id))) {
                            const newValue = value.filter(item => item !== parseInt(id))
                            $(this).parent().remove()
                            targetField.val(JSON.stringify(newValue))
                        }
                    }
                },
                successmultiple: function(file, response) {
                    if (multiple) {
                        const stored = response.stored

                        $(response.stored).each(function(idx, item) {
                            value.push(item.id)
                        })
                        targetField.val(JSON.stringify(value))
                    } else {
                        targetField.val(response.stored.path)
                        toastr.success(response.message)
                    }
                },
                success: function(file, response) {
                    targetField.val(response.stored.path)
                },
                error: function(file, response) {
                    if (!multiple && targetField.val()) {
                        toastr.error('cannot upload more than one file')
                    }
                    toastr.error(response.message)
                },
            });

        })

        const textEditors = $('.rich-text-editor');
        textEditors.each(function(idx, el) {
            const element = $(el)

            CKEDITOR.replace(element.attr('id'), {
                filebrowserUploadUrl: "{{ route('admin.media.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form',
                height: 500,
                contentsLangDirection: 'rtl'
            });

        })
    }

</script>
