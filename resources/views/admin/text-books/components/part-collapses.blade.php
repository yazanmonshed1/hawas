<table class="table border">
    <thead>
        <tr>
            <th>{{ __('labels.title') }}</th>
            <th>{{ __('admin.operations') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($part->collapses as $collapse)
            <tr>
                <td class="collapse-title">
                    {{ $collapse->title }}
                </td>
                <td class="d-flex">
                    <form class="submit_form_via_ajax mx-2"
                        action="{{ route('admin.about-us-collapses.destroy', [$collapse->id]) }}" method="POST"
                        callback="handleAddOrRemoveCollapseForPartResponse">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-collapse">{{ __('admin.delete') }}</button>
                    </form>
                    <a target-id="{{ $collapse->id }}"
                        class="btn btn-success action-edit-collapse mx-2">{{ __('admin.edit') }}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
