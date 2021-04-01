/* Zoom in Hover Image */
$(document).on('mouseenter', '.activity-book,.image-book', function () {
    let $this = $(this);
    $(this).find('.page-opacity').show()
    $(this).find('.zoom-div').show();
    /*$(this).find('.search_text_div').show()*/

});
$(document).on('mouseleave', '.activity-book,.image-book', function () {
    let $this = $(this);
    $(this).find('.page-opacity').hide()
    $(this).find('.zoom-div').hide()
    /*$(this).find('.search_text_div').hide()*/

});


/* Collapse show and hide */
$(document).ready(function () {
    $('#collapseOne').on('hide.bs.collapse', function () {
        $('.collapse_icon')
            .removeClass(' fa-caret-down')
            .addClass('fa-caret-up');

    })

    $(this).on('show.bs.collapse', function () {
        $('.collapse_icon')
            .removeClass('fa-caret-up')
            .addClass('fa-caret-down');

    })
})

$(document).on('click','.lightbox-toggle',function (e){
    e.stopPropagation()
    // e.preventDefault();
    let image=$(this).parent().parent().find('img').attr('src')
    $('#lightbox-target-page img').attr('src',image)
    
})
/*
lightbox-target*/
