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


