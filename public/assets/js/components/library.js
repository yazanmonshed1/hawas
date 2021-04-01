$(document).on('click', '.book-type', function () {
    let $this = $(this);
    $('.book-type').removeClass('book-type-active')
    $(this).addClass('book-type-active')
    /*$(this).find('.search_text_div').show()*/

});
