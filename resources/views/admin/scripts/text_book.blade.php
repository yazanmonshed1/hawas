<script>
    $(document).on('click', '.build-action', function(e) {
        e.preventDefault()
        var url = "{{ route('admin.text-books.edit', [':editForm']) }}";
        url = url.replace(':editForm', $(this).parent().parent().attr('id'))
        window.location = url
    })

</script>
