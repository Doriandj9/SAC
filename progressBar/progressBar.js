let formUpload = document.querySelector('#formUpload');
formUpload.addEventListener('submit', function(){
    let inputFile = document.querySelector('#inputFile').files[0];
    let progressBar = document.querySelector('#progressBar');

    let formData = new FormData();
    formData.append("inputFile", inputFile);
    let ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", function(e){
        let porcentaje = (e.loaded / e.total) * 100;
        progressBar.value = Math.round(porcentaje);
        console.log(progressBar);
    });

    ajax.open("POST", "enviar.php");
    ajax.send(formData);

});