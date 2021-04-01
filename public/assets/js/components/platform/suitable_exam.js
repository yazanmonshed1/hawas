$(document).ready(function () {
    const studentExamId = parseInt($('#student-exam-id').attr('target-id'));

    $.get(`/suitable/get-question/${studentExamId}`).done(function (data) {
        $('#question-container').html(data.html)
    })
})

$(document).on('click', '.answer-text-in-box', function () {
    $('.answer-text-in-box').removeClass('active')
    const answerId = parseInt($(this).attr('target-id'));
    const questionId = parseInt($('#question-id').attr('target-id'));
    const studentExamId = parseInt($('#student-exam-id').attr('target-id'));

    const el = $(this)

    $.post(`/suitable/answer/${studentExamId}/${questionId}/${answerId}`, {
        "_token": $('meta[name="csrf-token"]').attr('content')
    }).done(function (data) {
        if (data.finished) {
            $('#finished-button').removeClass('d-none')
        }
        el.addClass('active')
    })
})

$(document).on('click', '.get-question', function (e) {
    $('.change-ajax').addClass('div-change');
    $('.loading-ajax').show();
    e.preventDefault();
    const type = $(this).attr('navigate')
    const questionId = parseInt($('#question-id').attr('target-id'));
    const studentExamId = parseInt($('#student-exam-id').attr('target-id'));

    $.get(`/suitable/get-question/${studentExamId}/${questionId}/${type}/${parseInt($('#q_no').text())}`).done(function (data) {
        $('#question-container').html(data.html)
    })
})

$(document).on('click', '#finished-button', function (e) {
    const studentExamId = parseInt($('#student-exam-id').attr('target-id'));

    $.post(`/finish-exam/${studentExamId}`, {
        _token: $('meta[name="csrf-token"]').attr('content')
    }).done(function (data) {
        $('#question-container').html(data.html)
    })
})