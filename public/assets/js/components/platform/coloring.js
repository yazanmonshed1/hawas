var mousePressed = false;
var currentColor = $('.circle-color').css('background-color')
var lastX, lastY;
var ctx;

const image = $('#target-image')

function InitThis(firstTime = false) {
    const canvas = document.getElementById('myCanvas')
    ctx = canvas.getContext("2d");

    image.hide()

    canvas.width = window.innerWidth < 991 ? image.parent().parent().width() - 30 : image.width();
    canvas.height = image.height();

    if (image[0].complete) {
        ctx.drawImage(image[0], 0, 0, canvas.width, canvas.height)
    } else {
        image[0].onload = function () {
            ctx.drawImage(image[0], 0, 0, canvas.width, canvas.height)
        };
    }


    $('#myCanvas').mousedown(function (e) {
        mousePressed = true;
        if (forshayClicked) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
        }
    });

    $('#myCanvas').mousemove(function (e) {
        if (mousePressed && forshayClicked) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#myCanvas').mouseup(function (e) {
        mousePressed = false;
    });
    $('#myCanvas').mouseleave(function (e) {
        mousePressed = false;
    });

    $('.row-border-course').mouseleave(function () {
        forshayClicked = false
        cursor.css({
            top: 'initial',
            right: 'initial',
            left: 'initial',
            position: 'relative'
        });
        cursor.css('pointer-events', 'all')
        $('#blank-space').css('width', 0)
    })
}

function Draw(x, y, isDown) {
    if (isDown) {
        ctx.beginPath();
        ctx.strokeStyle = currentColor;
        ctx.lineWidth = $('#selWidth').val();
        ctx.lineJoin = "round";
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(x, y);
        ctx.closePath();
        ctx.stroke();
    }
    lastX = x;
    lastY = y;
}

function clearArea() {
    location.reload();
}


var forshayClicked = false;

var mouseOverCanvas = false;
$("canvas").mouseover(function () {
    mouseOverCanvas = true;
    if (forshayClicked) {
        $(this).css('cursor', 'none')
    }
});
$("canvas").mouseout(function () {
    mouseOverCanvas = false;
});

$('.cursor').on('click', function (e) {
    forshayClicked = true
    $('#blank-space').css('width', $(this).innerWidth())
    $('.app-container').prepend($('#blank-space'))
    console.log($('#blank-space'))

    $(this).css('pointer-events', 'none')
    $(this).css('position', 'absolute')
})

var cursor = $('.cursor');

$('#myCanvas').mousemove(function (e) {
    var rect = e.target.getBoundingClientRect();
    var x = e.clientX - rect.left;
    var y = e.clientY - rect.top;
    if (mouseOverCanvas && forshayClicked) {
        cursor.css({
            top: y - 10,
            left: x - 10,
        });
    }
});

$('.circle-color').on('click', function () {
    currentColor = $(this).css('background-color');
})

$(document).ready(function () {
    InitThis()
})
function exportPNG() {
    const canvas = document.getElementById('myCanvas')
    var img = canvas.toDataURL("image/png");

    const studentExamId = parseInt($('#student-exam-id').attr('target-id'));

    $.post(`/finish-exam/${studentExamId}`, {
        data: {
            image: img
        },
        _token: $('meta[name="csrf-token"]').attr('content')
    }).done(function (data) {
        alert('تم حفظ الجواب')
        $('#png-image').removeClass('d-none');
        $('#png-image .content').html('<img src="' + data.image + '"/>');
        $('.finished-button').hide();
    })

}