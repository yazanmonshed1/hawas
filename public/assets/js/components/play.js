$(document).ready(function (){
    /*  Play Image Hover  */
    $(document).on('mouseenter', '.play-img-name', function () {
        let $this = $(this);
        $(this).find('.play-img-opacity').show('flex')
        $(this).find('.play-name-div').show('flex')
        $(this).find('.insidePlay-name-div').show()
    });
    $(document).on('mouseleave', '.play-img-name', function () {
        let $this = $(this);
        $(this).find('.play-img-opacity').hide()
        $(this).find('.play-name-div').hide()
        $(this).find('.insidePlay-name-div').hide()
    });

    /* Play Image Zoom Hover (insidePlay Page)*/
    $(document).on('mouseenter', '.play-img', function () {
        let $this = $(this);
        $(this).find('.play-img-zoom-opacity').show()
        $(this).find('.play-name-div').show()
        $(this).find('.insidePlay-name-div').show()
    });
    $(document).on('mouseleave', '.play-img', function () {
        let $this = $(this);
        $(this).find('.play-img-zoom-opacity').hide()
        $(this).find('.play-name-div').hide()
        $(this).find('.insidePlay-name-div').hide()
    });
})



