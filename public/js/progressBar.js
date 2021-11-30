let formUpload = document.querySelector('#formUpload');
formUpload.addEventListener('submit', function(){
    let inputFile__Dtr = document.querySelector('#inputFile__Dtr').files[0];
    let progressBar1 = document.querySelector('#progressBar1');

    let formData = new FormData();
    formData.append("inputFile__Dtr", inputFile__Dtr);
    let ajax = XMLHttpRequest();
    ajax.upload.addEventListener("progress", function(e){
        let porcentaje = (e.loaded / e.total) * 100;
        progressBar1.value = Math.round(porcentaje);
    });

    ajax.open("POST", "");
    ajax.send(formData);

});

// let formUpload = document.querySelector('#formUpload');
// formUpload.addEventListener('submit', function(){
//     let inputFile__Dtr = document.querySelector('#inputFile__ListD').files[0];
//     let progressBar2 = document.querySelector('#progressBar2');

//     let formData = new FormData();
//     formData.append("inputFile__ListD", inputFile__Dtr);
//     let ajax = XMLHttpRequest();
//     ajax.upload.addEventListener("progress", function(e){
//         let porcentaje = (e.loaded / e.total) * 100;
//         progressBar2.value = Math.round(porcentaje);
//     });

//     ajax.open("POST", "");
//     ajax.send(formData);

// });
let formUpload = document.querySelector('#formUpload');
formUpload.addEventListener('submit', function(){
    let inputFile__Dtr = document.querySelector('#inputFile__ListD').files[0];
    let progressBar = document.querySelector('#progressBar');

    let formData = new FormData();
    formData.append("inputFile__ListD", inputFile__Dtr);
    let ajax = XMLHttpRequest();
    ajax.upload.addEventListener("progress", function(e){
        let porcentaje = (e.loaded / e.total) * 100;
        progressBar.value = Math.round(porcentaje);
    });

    ajax.open("POST", "subir.php");
    ajax.send(formData);

});
