/* Zoom Images for all */
$(document).ready(function () {
    lightbox.option({
        albumLabel: 'Image %1 of %6',
        alwaysShowNavOnTouchDevices: false,
        fadeDuration: 600,
        fitImagesInViewport: true,
        imageFadeDuration: 600,
        maxWidth: 1000,
        maxHeight: 1000,
        positionFromTop: 50,
        resizeDuration: 700,
        showImageNumberLabel: true,
        // wrapAround:false,// If true, when a user reaches the last activity in a set, the right navigation arrow will appear and they will be to continue moving forward which will take them back to the first activity in the set.

        /*disable<a href="https://www.jqueryscript.net/tags.php?/Scroll/">Scroll</a>ing:false,*/
        sanitizeTitle: false
    })

})

$(document).ready(function () {
    $(document).on('mouseenter', '.menu-item-action', function () {
        let $this = $(this);
        $('.menu-item-action').removeClass('menu-item-active')
        $(this).addClass('menu-item-active')
        // $('#programs-menu').removeClass('show');


    });
    $(document).on('mouseleave', '.activity-book', function () {
        let $this = $(this);
        $('.menu-item-action').removeClass('menu-item-active')
        $(this).addClass('menu-item-active')


    });

})

$(document).ready(function () {
    $(document).on('mouseover', '.program-menu', function () {
        $('#programs-menu').addClass('show');
    })
    $(document).on('mouseleave', '.program-menu', function () {
        $('#programs-menu').removeClass('show');
    })
    $(document).on('mouseover', '#programs-menu', function () {
        $(this).addClass('show');
    })
    $(document).on('mouseleave', '#programs-menu', function () {
        $(this).removeClass('show');
    })
})

/* Menu Arrow Hover */

$(document).ready(function () {
    $(document).on('mouseover', '.dropdown-toggle', function () {
        $('.multi-level').addClass('show');
    })
    $(document).on('mouseleave', '.dropdown-toggle', function () {
        $('.multi-level').removeClass('show');
    })
})


/* Click on menu arrow */

    $(document).on('click', '.arrow-plays-multi', function (e) {
        e.stopPropagation();
        e.preventDefault()
})
$(document).on('click', '.arrow-films-multi', function (e) {
    e.stopPropagation();
    e.preventDefault()
})
