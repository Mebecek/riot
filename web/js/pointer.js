var tooltips2 = document.querySelectorAll('.champion-spell-info');

window.onmousemove = function (e) {
    var x = (e.clientX + 20) + 'px',
        y = (e.clientY + 20) + 'px';
    for (var z = 0; z < tooltips2.length; z++) {
        tooltips2[z].style.top = y;
        tooltips2[z].style.left = x;
    }
};