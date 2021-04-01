$(document).ready(function () {

    let finalResults = []

    var canvas = document.getElementById('canvas');

    canvas.style.width = '100%';
    canvas.style.height = '450';
    canvas.width = canvas.offsetWidth;

    function removeRelated(from, to) {
        $('.val[current-key="' + from.attr('id') + '"]').removeAttr('current-key')
        $('.key[current-val="' + to.attr('id') + '"]').removeAttr('current-val')
    }

    function drawCondition(key, val) {
        const targetId = 'from_' + key
        let draw = $('<connection id="' + targetId + '" from="#' + key + '" to="#' + val + '" color="#aaaaaa" fromX="0" tail onlyVisible></connection>')
        $('#connection').append(draw)
    }

    function redrawAll() {
        const keys = $('.key');
        const vals = $('.val');
        $('connection').remove()
        vals.each(function (idx, el) {
            const element = $(el)
            if (element.attr('current-key')) {
                let from = element.attr('current-key')
                let fromElement = $('.' + from);
                let fromId = fromElement.attr('id');
                let toId = fromElement.attr('current-val')
                drawCondition(fromId, toId)
            }
        });
        let items = []
        keys.each(function (idx, el) {
            $(el).parent().parent().removeClass('removed-arrow')
        })
        keys.each(function (idx, el) {
            if ($(el).attr('current-val')) {
                $(el).parent().parent().addClass('removed-arrow')
                items.push({
                    key: $(el).attr('id').split('-')[1],
                    val: $(el).attr('current-val').split('-')[1],
                })
            }
        })
        finalResults = items
        if (items.length === keys.length) {
            $('#line-draw-finished').removeClass('d-none')
            finalResults = items
        } else {
            $('#line-draw-finished').addClass('d-none', true)
            finalResults = null
        }
    }


    // Drawing
    function getElement(e, type) {
        const elements = document.elementsFromPoint(e.clientX, e.clientY)
        var el = null
        $(elements).each(function (idx, item) {
            if ($(item).hasClass(type)) {
                el = $(item)
            }
        })
        return el;
    }

    var ctx = canvas.getContext('2d');
    //Variables
    var canvasx = $(canvas).offset().left;
    var canvasy = $(canvas).offset().top;
    var last_mousex = last_mousey = 0;
    var mousex = mousey = 0;
    var mousedown = false;

    //Mousedown
    $(canvas).on('mousedown', function (e) {
        const el = getElement(e, 'key');

        if (el) {
            $('.key').attr('selected', false)
            $('.key').removeClass('active')
            el.attr('selected', true)
            el.addClass('active')

            var rect = e.target.getBoundingClientRect();
            var x = e.clientX - rect.left; //x position within the element.
            var y = e.clientY - rect.top;  //y position within the element.

            last_mousex = parseInt(x);
            last_mousey = parseInt(y);
            mousedown = true;
        }
    });
    //Mouseup
    $(canvas).on('mouseup', function (e) {
        mousedown = false;
        const from = $('.key[selected="selected"]')
        const to = getElement(e, 'val')

        if (to) {
            removeRelated(from, to)
            to.attr('current-key', from.attr('id'))
            from.attr('current-val', to.attr('id'))
            redrawAll()
        }
        clearArea();
        from.removeAttr('selected')
        from.removeClass('active')
    });
    //Mousemove
    $(canvas).on('mousemove', function (e) {
        var rect = e.target.getBoundingClientRect();
        var x = e.clientX - rect.left; //x position within the element.
        var y = e.clientY - rect.top;  //y position within the element.

        mousex = parseInt(x);
        mousey = parseInt(y);
        if (mousedown) {
            ctx.clearRect(0, 0, canvas.width, canvas.height); //clear canvas
            ctx.beginPath();
            ctx.moveTo(last_mousex, last_mousey);
            ctx.lineTo(mousex, mousey);
            ctx.stroke();
        }
    });

    function clearArea() {
        ctx.setTransform(1, 0, 0, 1, 0, 0);
        ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
    }

    // Submit
    $(document).on('click', '#line-draw-finished', function (e) {
        console.log('finalResults : ', finalResults)
        const studentExamId = parseInt($('#student-exam-id').attr('target-id'));

        $.post(`/finish-exam/${studentExamId}`, {
            data: finalResults,
            _token: $('meta[name="csrf-token"]').attr('content')
        }).done(function (data) {
            alert('تم حفظ الجواب')
            $('#line-draw-container').html(data.html)
        })
    })
})
