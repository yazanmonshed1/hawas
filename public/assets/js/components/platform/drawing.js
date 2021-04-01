var canvas = this.__canvas = new fabric.Canvas('c');
// create a rect object
var deleteIcon =
    "data:image/svg+xml,%3C%3Fxml version='1.0' encoding='utf-8'%3F%3E%3C!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'%3E%3Csvg version='1.1' id='Ebene_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='595.275px' height='595.275px' viewBox='200 215 230 470' xml:space='preserve'%3E%3Ccircle style='fill:%23F44336;' cx='299.76' cy='439.067' r='218.516'/%3E%3Cg%3E%3Crect x='267.162' y='307.978' transform='matrix(0.7071 -0.7071 0.7071 0.7071 -222.6202 340.6915)' style='fill:white;' width='65.545' height='262.18'/%3E%3Crect x='266.988' y='308.153' transform='matrix(0.7071 0.7071 -0.7071 0.7071 398.3889 -83.3116)' style='fill:white;' width='65.544' height='262.179'/%3E%3C/g%3E%3C/svg%3E";

var img = document.createElement('img');
img.src = deleteIcon;

// variables
var color = 'blue';
var changeColor = false;
var cursor = $('.cursor');

fabric.Object.prototype.transparentCorners = false;
fabric.Object.prototype.cornerColor = 'blue';
fabric.Object.prototype.cornerStyle = 'circle';

function AddRect() {
    var rect = new fabric.Rect({
        left: 100,
        top: 100,
        fill: 'white',
        width: 100,
        height: 100,
        objectCaching: false,
        stroke: 'black',
    });

    canvas.add(rect);
    canvas.setActiveObject(rect);
}

function AddTriangle() {
    var triangle = new fabric.Triangle({
        width: 50,
        height: 50,
        fill: 'white',
        left: 50,
        top: 50,
        stroke: 'black',
    });

    canvas.add(triangle);
    canvas.setActiveObject(triangle);
}

function AddCircle() {
    var circle = new fabric.Circle({
        radius: 50,
        fill: 'white',
        stroke: 'black',
    });
    canvas.add(circle);
    canvas.setActiveObject(circle);
}

function AddLine() {
    var line = new fabric.Line([50, 100, 200, 200], {
        left: 170,
        top: 150,
        fill: 'white',
        stroke: 'black'
    })
    canvas.add(line);
    canvas.setActiveObject(line);
}

function AddTest() {
    var imgElement = document.getElementById('incline');
    var imgInstance = new fabric.Image(imgElement, {
        left: 10,
        top: 10,
        angle: 0,
        width: 70,
        height: 70
    });
    canvas.add(imgInstance);
    canvas.renderAll()
}

fabric.Object.prototype.controls.deleteControl = new fabric.Control({
    x: 0.5,
    y: -0.5,
    offsetY: 16,
    cursorStyle: 'pointer',
    mouseUpHandler: deleteObject,
    render: renderIcon,
    cornerSize: 24
});

AddRect();

function deleteObject(eventData, target) {
    // console.log(target)
    // canvas.getActiveObject().set("fill", color);
    canvas.remove(canvas.getActiveObject());
    canvas.renderAll();

}

function renderIcon(ctx, left, top, styleOverride, fabricObject) {
    var size = this.cornerSize;
    ctx.save();
    ctx.translate(left, top);
    ctx.rotate(fabric.util.degreesToRadians(fabricObject.angle));
    ctx.drawImage(img, -size / 2, -size / 2, size, size);
    ctx.restore();
}

$('.colors > div').on('click', function () {
    color = this.style.backgroundColor
    changeColor = true
    cursor.removeClass('d-none');
    cursor.show();
})

// Events handling
canvas.on('mouse:down', (options) => {
    console.log(options.target)
    if (options.target) {
        // Bring to front
        let activeObject = canvas.getActiveObject()
        let activeObjectIndex = canvas.getObjects().indexOf(activeObject)
        const allObjects = canvas.getObjects()
        allObjects.push(allObjects.splice(activeObjectIndex, 1)[0]);
        activeObject && canvas.bringToFront(activeObject).renderAll();

        // Handle Color change
        if (changeColor) {
            canvas.getActiveObject().set('fill', color)
            changeColor = false
            cursor.hide();
        }
    } else {
        changeColor = false
        cursor.hide();
    }
});

$(window).mousemove(function (e) {
    if (changeColor) {
        cursor.css({
            top: e.clientY - 5,
            left: e.clientX - 3
        });
    }
});

function exportPNG() {
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