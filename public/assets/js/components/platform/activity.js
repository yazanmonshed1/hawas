$(document).ready(function () {
    $(document).on('click', '.course-name', function () {
        let $this = $(this);
        $('.course-name').find('.activity-text').removeClass('course-name-active')
        $(this).find('.activity-text').addClass('course-name-active')
    });

})
$(document).ready(function () {
    $(document).on('click', '.radio-answer', function () {
        let $this = $(this);
        $('.radio-answer').removeClass('radio-answer-active')
        $(this).addClass('radio-answer-active')

    });
});
