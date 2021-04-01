@extends('admin.layouts.dashboard')

@section('body')

    <h1>{{ __('admin.build') . ' ' . __('models.text_books.singular') . ' - ' . $book->title }}
    </h1>

    <form callback="handlePartAddResponse" action="{{ route('admin.text-books.add-part', [$book->id]) }}" method="POST"
        class="submit_form_via_ajax d-flex justify-content-start align-items-end">
        @csrf
        <div class="form-group">
            <label for="part-title">{{ __('labels.add_new_section') }}</label>
            <input type="text" class="form-control" name="title" id="part-title">
        </div>
        <div class="form-group px-3">
            <button class="btn btn-primary">
                {{ __('admin.add') }}
            </button>
        </div>
    </form>
    <div id="parts-container">
        @include('admin.text-books.components.parts')
    </div>

    <div class="modal fade" id="addCollapseModal" tabindex="-1" role="dialog" aria-labelledby="addCollapseTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCollapseTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="my-3">
        <a href="{{ url()->previous() }}" class="btn btn-primary">{{ __('admin.back') }}</a>
    </div>

@endsection
@section('script')
    @include('admin.scripts.add-edit-script')
    @isset($additional_script)
        @include('admin.scripts.' . $additional_script)
    @endisset

    <script>
        function handlePartAddResponse(form) {
            form.ajaxSubmit({
                dataType: "JSON",
                data: {
                    json: true
                },
                success: function(res) {
                    $('#addCollapseModal').modal('hide')
                    if (res.html) {
                        $('#parts-container').html(res.html)
                    }
                },
                error: function(exception) {
                    formErrorsHandler(exception, form)
                }
            });
        }

        function handleAddOrRemoveCollapseForPartResponse(form) {
            form.ajaxSubmit({
                dataType: "JSON",
                data: {
                    json: true
                },
                success: function(res) {
                    $('#addCollapseModal').modal('hide')
                    if (res.html) {
                        $('#parts-container .collapse.show .parts-body').html(res.html)
                    }
                },
                error: function(exception) {
                    formErrorsHandler(exception, form)
                }
            });
        }

        // Add collapse for part
        $(document).on('click', '.action-add', function(e) {
            e.preventDefault();
            const id = $(this).attr('target-id')

            let formRoute = "{{ route('admin.get-data.get-new-form', ['createForPart']) }}"
            $.get(formRoute, {
                modelName: 'Collapse',
                action: "{{ route('admin.collapses.create-for-part') }}",
                text_book_part_id: id
            }).done(function(data) {
                $('.modal-body').html(data);
                makeFileUploader($('#addCollapseModal .dropzone'));
                $('#addCollapseTitle').html("{{ __('admin.create') . ' ' . __('Text book content') }}")
                $('#addCollapseModal').modal('show')
            })
        })

        $(document).on('click', '.action-edit-collapse', function(e) {
            e.preventDefault();
            $('.selected-collase').removeClass('selected-collase');
            $(this).parent().parent().addClass('selected-collase')
            const id = $(this).attr('target-id');
            console.log(id)
            let formRoute = "{{ route('admin.get-data.get-form', ['editForPart']) }}"
            $.get(formRoute, {
                modelName: 'Collapse',
                action: 'admin.collapses.update-for-part',
                id: id
            }).done(function(data) {
                $('.modal-body').html(data);
                makeFileUploader($('#addCollapseModal .dropzone'));
                $('#addCollapseTitle').html("{{ __('admin.edit') . ' ' . __('Text book content') }}")
                $('#addCollapseModal').modal('show')
            })
        })

        $(document).on('click', '.delete-part', function(e) {
            e.preventDefault()
            e.stopPropagation()
            $(this).parent().submit()
        })

        $(document).on('click', '.edit-part-text', function(e) {
            e.preventDefault()
            e.stopPropagation()
            const id = $(this).attr('target-id')
            const text_book_id = $(this).attr('text-book-id')
            let formRoute = "{{ route('admin.get-data.get-form', ['createForm']) }}"
            $.get(formRoute, {
                modelName: 'TextBookPart',
                action: 'admin.text-book-parts.update',
                id: id,
                text_book_id: text_book_id
            }).done(function(data) {
                $('.modal-body').html(data);
                makeFileUploader($('#addCollapseModal .dropzone'));
                $('#addCollapseTitle').html("{{ __('admin.edit') . ' ' . __('Text book content') }}")
                $('#addCollapseModal').modal('show')
            })
        })

    </script>
@endsection
