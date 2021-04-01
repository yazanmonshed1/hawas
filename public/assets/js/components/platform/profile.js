$(document).ready(function () {
    $(document).on('click', '#delete-activity', function () {
        Swal.fire({
            title: 'هل ترغب بحذف هذه الصورة؟',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم, احذف'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'تم الحذف',
                    '',
                    'success'
                )
                $('.profile-stu-img').remove();
            }
        })

    })
})

$(document).on('change', '#upload-img', async function (e) {
    const file = e.target.files[0];
    const base64 = await toBase64(file)
    $.post(`/profile/update-image`, {
        _token: $('meta[name="csrf-token"]').attr('content'),
        image: base64
    }).done(function (data) {
        $('#profile-user-image').attr('src', `/storage/${data.path}`)
    })
})

$(document).on('click', '#delete-image', function (e) {
    e.preventDefault()
    $.get(`/profile/remove-image`).done(function (data) {
        $('#profile-user-image').attr('src', `/storage/${data.path}`)
    })
})

const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});