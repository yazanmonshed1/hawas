/* Film Image Title Hover */
$(document).ready(function (){

})



/* Film Image Zoom Hover (insideFilm Page)*/
$(document).ready(function (){
    $(document).on('mouseenter', '.film-img', function () {
        let $this = $(this);
        $(this).find('.film-img-zoom-opacity').show()
        $(this).find('.film-name-div').show()
    });
    $(document).on('mouseleave', '.film-img', function () {
        let $this = $(this);
        $(this).find('.film-img-zoom-opacity').hide()
        $(this).find('.film-name-div').hide()
    });

    $(document).on('mouseenter', '.film-img-name', function () {
        let $this = $(this);
        $(this).find('.film-img-opacity').show()
        $(this).find('.film-name-div').show()
    });
    $(document).on('mouseleave', '.film-img-name', function () {
        let $this = $(this);
        $(this).find('.film-img-opacity').hide()
        $(this).find('.film-name-div').hide()
    });
})



