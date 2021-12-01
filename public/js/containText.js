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
