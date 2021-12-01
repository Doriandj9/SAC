(function () {
  let button = document.querySelector("#saveFile__Dtr");
  let formUpload = document.querySelector("#formUpload");
  let arrayButtons = Array.from(document.getElementsByTagName("button"));
  arrayButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      
      let inputName = button.getAttribute("id");
      let progressB = "#" + inputName + "P";
      inputName = "#" + inputName + "I";
      
      let input = document.querySelector(inputName);
      let inputP = document.querySelector(progressB);

      save(input.files[0], inputP, inputName);
    });
  });

  function save(inputFile, progressB, name) {
    console.log(progressB);
    let xhr = new XMLHttpRequest();

    let d = new Date();

    const data = new FormData();
    const time = d.getTime();
    data.append("file", inputFile);
    data.append("time", time);
    data.append("option", name);
    xhr.open("POST", "/coordinator/upload/information", true);
    console.log(xhr);
    xhr.upload.addEventListener("progress", function (e) {
      let porcentaje = (e.loaded / e.total) * 100;
      progressB.value = Math.round(porcentaje);
    });
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          if (xhr.response) {
            console.log(xhr.response);
          }
        } else {
          console.error(xhr.statusText);
          alert("Upload error!");
        }
      }
    };
    xhr.send(data);
    console.log(inputFile);
    console.log("Hola desde la funcion");
  }
})();

// let button = document.querySelector('#saveFile__Dtr');

// let formUpload = document.querySelector('#formUpload');
// formUpload.addEventListener('submit', function(){
//     let inputFile__Dtr = document.querySelector('#inputFile__Dtr').files[0];
//     let progressBar1 = document.querySelector('#progressBar1');

//     let formData = new FormData();
//     formData.append("inputFile__Dtr", inputFile__Dtr);
//     console.log(inputFile__Dtr);
//     let ajax = new XMLHttpRequest();
//     ajax.upload.addEventListener("progress", function(e){
//         let porcentaje = (e.loaded / e.total) * 100;
//         progressBar1.value = Math.round(porcentaje);
//     });

//     ajax.open("POST", "/coordinator/upload/information");
//     ajax.send(formData);

//     ajax.onreadystatechange() = function () {
//         if (ajax.readyState === 4) {
//             if (ajax.status === 200) {
//                 if (ajax.response) {

//                         console.log(ajax.response);

//                 }
//             } else {
//                 console.error(ajax.statusText);
//                 alert("Upload error!");
//             }
//         }
//     }

// });

// // let formUpload = document.querySelector('#formUpload');
// // formUpload.addEventListener('submit', function(){
// //     let inputFile__Dtr = document.querySelector('#inputFile__ListD').files[0];
// //     let progressBar2 = document.querySelector('#progressBar2');

// //     let formData = new FormData();
// //     formData.append("inputFile__ListD", inputFile__Dtr);
// //     let ajax = XMLHttpRequest();
// //     ajax.upload.addEventListener("progress", function(e){
// //         let porcentaje = (e.loaded / e.total) * 100;
// //         progressBar2.value = Math.round(porcentaje);
// //     });

// //     ajax.open("POST", "");
// //     ajax.send(formData);

// // });
// let formUpload = document.querySelector('#formUpload');
// formUpload.addEventListener('submit', function(){
//     let inputFile__Dtr = document.querySelector('#inputFile__ListD').files[0];
//     let progressBar = document.querySelector('#progressBar');

//     let formData = new FormData();
//     formData.append("inputFile__ListD", inputFile__Dtr);
//     let ajax = XMLHttpRequest();
//     ajax.upload.addEventListener("progress", function(e){
//         let porcentaje = (e.loaded / e.total) * 100;
//         progressBar.value = Math.round(porcentaje);
//     });

//     ajax.open("POST", "subir.php");
//     ajax.send(formData);

// });
