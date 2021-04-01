<script>
    $(document).on('click', '.build-action', function(e) {
        e.preventDefault()
        e.stopPropagation()
        var url = "{{ route('admin.digital-books.build', [':id']) }}";
        url = url.replace(':id', $(this).parent().parent().attr('id'))
        window.location = url
    })

</script>
