let inputFile = document.querySelector('#inputFile');
inputFile.addEventListener('change', function(){
    let text = this.value;
    text = text.replace(/^.*\\/, "");
    document.getElementById("fileText").value = text;
});