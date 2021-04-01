const cardsArray = JSON.parse($('#cards').val())

var finished = false
var attempts = 0
var time = 0

var gameGrid = cardsArray.concat(cardsArray).sort(function () {
    return 0.5 - Math.random();
});

var firstGuess = '';
var secondGuess = '';
var count = 0;
var previousTarget = null;
var delay = 600;

var game = document.getElementById('game');
var grid = document.createElement('section');
grid.setAttribute('class', 'grid cards-container');
game.appendChild(grid);

gameGrid.forEach(function (item) {
    var name = item.name,
        img = item.img;


    var card = document.createElement('div');
    card.classList.add('card');
    card.dataset.name = name;

    var front = document.createElement('div');
    front.classList.add('front');

    var back = document.createElement('div');
    back.classList.add('back');
    back.style.backgroundImage = 'url(' + img + ')';

    grid.appendChild(card);
    card.appendChild(front);
    card.appendChild(back);
});

var match = function match() {
    var selected = document.querySelectorAll('.selected');
    selected.forEach(function (card) {
        card.classList.add('match');
        $('.true-div').show();
        $('.false-div').hide();
    });
};

var resetGuesses = function resetGuesses() {
    firstGuess = '';
    secondGuess = '';
    count = 0;
    previousTarget = null;

    var selected = document.querySelectorAll('.selected');
    selected.forEach(function (card) {
        card.classList.remove('selected');
    });

    if ($('.cards-container > .card').length == $('.cards-container > .card.match').length) {
        const studentExamId = parseInt($('#student-exam-id').attr('target-id'));

        $.post(`/finish-exam/${studentExamId}`, {
            data: {
                attempts: attempts,
                time: time
            },
            _token: $('meta[name="csrf-token"]').attr('content')
        }).done(function (data) {
            if (data.success) {
                alert('تم حفظ الجواب')
            }
        })
    }

};

grid.addEventListener('click', function (event) {

    var clicked = event.target;

    if (clicked.nodeName === 'SECTION' || clicked === previousTarget || clicked.parentNode.classList
        .contains('selected') || clicked.parentNode.classList.contains('match')) {
        return;
    }

    if (count < 2) {
        count++;
        if (count === 1) {
            firstGuess = clicked.parentNode.dataset.name;
            clicked.parentNode.classList.add('selected');
        } else {
            secondGuess = clicked.parentNode.dataset.name;
            clicked.parentNode.classList.add('selected');
            attempts += 1
        }

        if (firstGuess && secondGuess) {
            if (firstGuess === secondGuess) {
                setTimeout(match, delay);
            }
            setTimeout(resetGuesses, delay);
            $('.false-div').show();
            $('.true-div').hide();
        }
        previousTarget = clicked;
    }
});
$(document).ready(function () {
    var id = setInterval(function () {
        time += 1
    }, 1000);
});