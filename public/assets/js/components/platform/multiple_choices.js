$(document).on('click', '#get-first-question', function (e) {
    e.preventDefault();
    const studentExamId = parseInt($('#student-exam-id').attr('target-id'));

    $.get(`/multiple/get-question/${studentExamId}`).done(function (data) {
        $('#video-questions-container').html(data.html)
    })
})

$(document).on('click', '.multiple-choice-answer', function () {
    const answerId = parseInt($(this).attr('target-id'));
    const questionId = parseInt($('#question-id').attr('target-id'));
    const studentExamId = parseInt($('#student-exam-id').attr('target-id'));

    $.post(`/multiple/answer/${studentExamId}/${questionId}/${answerId}/${parseInt($('#q_no').text())}`, {
        "_token": $('meta[name="csrf-token"]').attr('content')
    }).done(function (data) {
        if (data.finished) {
            $('#finished-button').removeClass('d-none')
        }
    })
})

$(document).on('click', '.go-to-question', function (e) {
    $('.change-ajax').addClass('div-change');
    $('.loading-ajax').show();
    e.preventDefault();
    const type = $(this).attr('navigate')
    const questionId = parseInt($('#question-id').attr('target-id'));
    const studentExamId = parseInt($('#student-exam-id').attr('target-id'));

    $.get(`/multiple/get-question/${studentExamId}/${questionId}/${type}/${parseInt($('#q_no').text())}`).done(function (data) {
        $('#video-questions-container').html(data.html)
    })
})

$(document).on('click', '#finished-button', function (e) {
    const studentExamId = parseInt($('#student-exam-id').attr('target-id'));

    $.post(`/finish-exam/${studentExamId}`, {
        _token: $('meta[name="csrf-token"]').attr('content')
    }).done(function (data) {
        $('#video-questions-container').html(data.html)
    })
})