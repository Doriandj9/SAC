let inputFile__Dtr = document.querySelector('#saveFile__DtrI');
inputFile__Dtr.addEventListener('change', function(){
    let text = this.value;
    text = text.replace(/^.*\\/, "");
    document.getElementById("fileText__Dtr").value = text;
});

let inputFile__ListD = document.querySelector('#saveFile__ListDI');
inputFile__ListD.addEventListener('change', function(){
    let text = this.value;
    text = text.replace(/^.*\\/, "");
    document.getElementById("fileText__ListD").value = text;
});

let inputFile__Crt = document.querySelector('#saveFile__CrtI');
inputFile__Crt.addEventListener('change', function(){
    let text = this.value;
    text = text.replace(/^.*\\/, "");
    document.getElementById("fileText__Crt").value = text;
});

let inputFile__Est = document.querySelector('#saveFile__EstI');
inputFile__Est.addEventListener('change', function(){
    let text = this.value;
    text = text.replace(/^.*\\/, "");
    document.getElementById("fileText__Est").value = text;
});

let inputFile__Elm = document.querySelector('#saveFile__ElmI');
inputFile__Elm.addEventListener('change', function(){
    let text = this.value;
    text = text.replace(/^.*\\/, "");
    document.getElementById("fileText__Elm").value = text;
});

let inputFile__Elme = document.querySelector('#saveFile__ElmeI');
inputFile__Elme.addEventListener('change', function(){
    let text = this.value;
    text = text.replace(/^.*\\/, "");
    document.getElementById("fileText__Elme").value = text;
});