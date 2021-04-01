@if ($model->hasPermission('add'))
    <div class="d-flex justify-content-end alig-items-center mb-3">
        {{-- <button class="btn btn-danger mx-3">{{ __('admin.bulk_delete') }}</button> --}}
        <a href="{{ route('admin.' . $dataTableRequest['routeSlug'] . '.create') }}"
            class="d-flex align-items-center text-success add-action">
            <i class="fa fa-plus px-2"></i>
            <span>{{ __('admin.add') . ' ' . __('models.' . $dataTableRequest['nameSlug'] . '.singular') }}</span>
        </a>
    </div>
@endif
<table id="{{ $dataTableRequest['id'] }}" class="table table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th></th>
            <th></th>
            @foreach ($labels as $label)
                <th>{{ __('models.' . $model->getSlug() . '.columns.' . $label) }}</th>
            @endforeach
            <th style="pointer-events: none">{{ __('admin.operations') }}</th>
        </tr>
    </thead>
    <tbody>
</table>

<div class="modal fade" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="addEditModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEditModalTitle"></h5>
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

<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeModalTitle">{{ __('admin.are_you_sure_delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button class="btn btn-danger approve-delete">{{ __('admin.yes') }}</button>
                <button class="btn btn-secondary" data-dismiss="modal">{{ __('admin.no') }}</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.close') }}</button>
            </div>
        </div>
    </div>
</div>

@section('script')

    <script>
        function htmlDecode(input) {
            var e = document.createElement('div');
            e.innerHTML = input;
            return e.childNodes[0].nodeValue;
        }

        const targetRequest = JSON.parse(htmlDecode("{{ json_encode($dataTableRequest) }}").replace(/&quot;/g, '"'))

        let newRequest = {
            rowId: 'id',
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.get-data.datatable') }}",
                data: targetRequest.data
            },
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            order: [
                [1, 'asc']
            ],
            orderFixed: [0, 'desc'],
            columns: targetRequest.columns,
            language: {
                url: "{{ asset('admin/assets/languages/datatable/' . app()->getLocale() . '.json') }}"
            },
        }
        newRequest.columns.unshift({
            data: 'id',
            defaultContent: '',
            visible: false
        }, {
            data: '',
            defaultContent: '',
            orderable: false,
            className: 'select-checkbox',
            targets: 1
        })
        var table = $('#' + targetRequest.id).DataTable(newRequest);

        $(document).on('click', 'tbody tr', function() {
            if ($(this).has('.dataTables_empty').length > 0) {
                return null
            }
            const id = $(this).attr('id')
            let showRoute = "{{ route('admin.get-data.show-item') }}"

            showRoute += '?modelName=' + modelName;
            showRoute += '&id=' + id;
            showRoute += '&relationships=' + relationships;
            showRoute += '&columns=' + columns;

            $.get(showRoute, {
                modelName: modelName,
                id: id,
                relationships: relationships,
                columns: columns,
            }).done(function(data) {
                $('#addEditModal .modal-body').html(data);
                $('#addEditModalTitle').html("{{ __('admin.show') }}" + " " +
                    "{{ __('models.' . $dataTableRequest['nameSlug'] . '.singular') }}")
                $('#addEditModal').modal('show')
            })
        })

        $(document).on('click', '.select-checkbox', function(e) {
            e.stopPropagation()
        })

        const modelName = targetRequest.data.modelName;
        const columns = targetRequest.columns.map(item => item.data).filter(el => el != null && el != '');
        const relationships = targetRequest.data.relationships

    </script>

    @if (array_key_exists('popup', $dataTableRequest))
        <script>
            // Add
            $(document).on('click', '.add-action', function(e) {
                e.preventDefault()
                let formRoute = "{{ route('admin.get-data.get-form', [':create_form']) }}"
                formRoute = formRoute.replace(':create_form', targetRequest.popup.create_form);
                $.get(formRoute, {
                    modelName: modelName,
                    action: targetRequest.popup.store_action,
                }).done(function(data) {
                    $('#addEditModal .modal-body').html(data);
                    $('#addEditModalTitle').html("{{ __('admin.create') . ' ' }}" +
                        "{{ __('models.' . $dataTableRequest['nameSlug'] . '.singular') }}")
                    $('#addEditModal').modal('show')
                    initUploaders()
                    reloadScript()
                })
            })

            // Edit
            $(document).on('click', '.action-edit', function(e) {
                const id = $(this).closest('tr').attr('id');
                e.stopPropagation();
                let formRoute = "{{ route('admin.get-data.get-form', [':edit_form']) }}"
                formRoute = formRoute.replace(':edit_form', targetRequest.popup.edit_form);
                $.get(formRoute, {
                    modelName: modelName,
                    action: targetRequest.popup.update_action,
                    id: id
                }).done(function(data) {
                    $('#addEditModal .modal-body').html(data);
                    $('#addEditModalTitle').html("{{ __('admin.edit') . ' ' }}" +
                        "{{ __('models.' . $dataTableRequest['nameSlug'] . '.singular') }}")
                    $('#addEditModal').modal('show')
                    initUploaders()
                    reloadScript()
                })

            })

            // Delete
            $(document).on('click', '.action-delete', function(e) {
                e.stopPropagation();
                $('#removeModal').modal('show');
                const id = $(this).closest('tr').attr('id');

                $(document).on('click', '.approve-delete', function() {
                    var url = "{{ route('admin.delete-row', ':id') }}"
                    url = url.replace(':id', id)
                    $.post(url, {
                        modelName: modelName,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    }).done(function() {
                        table.row($(this).closest('tr')).remove().draw();
                    })
                    table.draw();
                    $('#removeModal').modal('hide');
                })
            })

        </script>
    @else
        @if ($model->hasPermission('edit'))
            <script>
                $(document).on('click', '.action-edit', function(e) {
                    const id = $(this).closest('tr').attr('id');
                    var url = "{{ route('admin.' . $dataTableRequest['routeSlug'] . '.edit', ':id') }}";
                    url = url.replace(':id', id);
                    window.location = url
                })
            </script>
        @endif
        @if ($model->hasPermission('delete'))
            <script>
                // Delete
                $(document).on('click', '.action-delete', function(e) {
                    e.stopPropagation();
                    $('#removeModal').modal('show');
                    const id = $(this).closest('tr').attr('id');
        
                    $(document).on('click', '.approve-delete', function() {
                        var url = "{{ route('admin.delete-row', ':id') }}"
                        url = url.replace(':id', id)
                        $.post(url, {
                            modelName: modelName,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        }).done(function() {
                            table.row($(this).closest('tr')).remove().draw();
                        })
                        table.draw();
                        $('#removeModal').modal('hide');
                    })
                })
            </script>
        @endif
    @endif

    @include('admin.scripts.add-edit-script')

    @isset($dataTableRequest['additional_script'])
        @include('admin.scripts.' . $dataTableRequest['additional_script'])
    @endisset
@endsection
