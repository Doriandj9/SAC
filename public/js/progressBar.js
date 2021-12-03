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
            analizadorJsonResponse(xhr.response);
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

  /**
   * Esta funcion analiza el JSON que devuelve el servidor al almacenar la informacion en la base de datos 
   * Ademas de separar los dos JSON que son la respuesta de que se guardo el archivo en el servidor local
   * Y el resulta al almacenar los datos en la base de datos con la funcion split se separa los JSONs
   * para luego trabajar con cada Json por separado   
   */
  function analizadorJsonResponse(response){
      let jsons = response.split('|').map(res => JSON.parse(res));
      const resulArchivoGuardado= jsons[0];
      const resultDatosGuardadosDB = jsons[1];
      console.log(resulArchivoGuardado);
      let reslutGuardadoBD = `<h1 class="margin-top-2 margin-buttom-2-5" style="text-align: center ;">
       Resultado de guardar la informacion en la base de datos
        </h1>`;
      /**
           * Aqui el codigo verifica si no existe la propiedad posiciones.error.result se lanze un error 
           * Y por ende en cath lo captura y realiza las procedimentos para guardarse en la variable que se va a presentar en la vista 
           */
      try {
        if (resultDatosGuardadosDB.result == undefined){
          throw new Error();
        }
        let resutl = `<p style="text-align: center ;" > ${resultDatosGuardadosDB.result} </p>` ;
        reslutGuardadoBD += resutl;   
      
    }catch (error) {
      resultDatosGuardadosDB.forEach(posiciones => {
        let resutl =  posiciones.error.errorInfo.reduce((acum,items) => acum+items);
        reslutGuardadoBD += `<p> <strong> Error : </strong> ${resutl} <br>`
        +` <strong> Archivo causante : </strong> ${JSON.stringify(posiciones.info_data)} </p>`;
               
      })
    };

        
     reslutGuardadoBD += `<button id="entendido-cerrar" class="">Cerrar</button>`;

     pictureResult(reslutGuardadoBD);

  }
  /**
   * 
   * Esta funcion renderiza el resultado que manda la funcion que analiza los JSONs ya sea 
   * los errores o si todo funciono correctamente 
   */

  function pictureResult(res){
    const contentResult = document.createElement('div');
    const maincontainSac= document.getElementById('maincontain-sac');
    contentResult.classList.add('visualizacion-resultados');
    contentResult.setAttribute('id','visualizacion-Res')
    contentResult.innerHTML = res;
    maincontainSac.append(contentResult);
    cerrarVistaResult();
  }
  /**
   * Esta funcion realiza la accion de cerra la ventana que se presentan los errores o si salio correcto todo que renderiza la funcion picture Result
   */
  function cerrarVistaResult(){
  const buttonCerrarResult = document.getElementById('entendido-cerrar');
  buttonCerrarResult.addEventListener('click', e => {
    e.preventDefault();
    console.log('si valio');
    const contentResult = document.getElementById('visualizacion-Res');
      contentResult.remove();
  })
}
})();


