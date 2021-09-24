/**Funcion para mostrar y ocultar clave */
function show() {
    console.log("hola");
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'text');
}

function hide() {
    console.log("hola");
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'password');
}

var pwShown = 0;

document.getElementById("eye").addEventListener("click", function () {
    console.log("hola");
    if (pwShown == 0) {
        pwShown = 1;
        show();
    } else {
        pwShown = 0;
        hide();
    }
}, false);
/** Funcion activar menu */




