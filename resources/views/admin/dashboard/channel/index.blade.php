@extends('admin.layouts.dashboard')

@section('body')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.channel-manager.fetch') }}" class="btn btn-success">{{ __('Update videios list') }}</a>
    </div>

    {!! $form !!}

@endsection

@section('script')
    @include('admin.scripts.add-edit-script')
<script>
    $(document).on('click', '.channel-item', function() {
        $(this).toggleClass('selected')
    })

    $(document).on('click', 'button[type="submit"]', function(event) {
        event.preventDefault()
        var selected = []
        $('.channel-item.selected').each(function(idx, el) {
            selected.push($(el).attr('id'))
        })
        $('#videos').val(selected)
        $('#videosForm').submit();
    })

</script>

@endsection
