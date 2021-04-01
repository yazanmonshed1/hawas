$(document).on('click', '#puzzle-finished', function (e) {
    const studentExamId = parseInt($('#student-exam-id').attr('target-id'));

    $.post(`/finish-exam/${studentExamId}`, {
        _token: $('meta[name="csrf-token"]').attr('content')
    }).done(function (data) {
        toastr.success('hi');
        alert('تم حفظ الجواب')
        console.log(data)
    })
})