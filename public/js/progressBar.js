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

      if (input.value.length > 0) {
        save(input.files[0], inputP, inputName);
      }
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
