/**Funcion para mostrar y ocultar clave */
function show() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'text');
}

function hide() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'password');
}

var pwShown = 0;

document.getElementById("eye") == null ? '' : document.getElementById("eye").addEventListener("click", function () {
    console.log("hola");
    if (pwShown == 0) {
        pwShown = 1;
        show();
    } else {
        pwShown = 0;
        hide();
    }
}, false);
/** FUNCION PARA MOSTRAR Y OCULTAR CLAVE POR MEDIO DE BOTON */
document.querySelector('.show span').addEventListener('click', e => {
    const passwordInput = document.querySelector('#password');
    if (e.target.classList.contains('show')) {
        e.target.classList.remove('show');
        e.target.textContent = 'Ocultar';
        passwordInput.type = 'text';
    } else {
        e.target.classList.add('show');
        e.target.textContent = 'Mostrar';
        passwordInput.type = 'password';
    }
});
// CONTINUE FUNCTION BACK
document.querySelector('.show2 span').addEventListener('click', e => {
    const passwordInput2 = document.querySelector('#passwordnew');
    if (e.target.classList.contains('show')) {
        e.target.classList.remove('show');
        e.target.textContent = 'Ocultar';
        passwordInput2.type = 'text';
    } else {
        e.target.classList.add('show');
        e.target.textContent = 'Mostrar';
        passwordInput2.type = 'password';
    }
});

document.querySelector('.show3 span').addEventListener('click', e => {
    const passwordInput3 = document.querySelector('#passwordnew1');
    if (e.target.classList.contains('show')) {
        e.target.classList.remove('show');
        e.target.textContent = 'Ocultar';
        passwordInput3.type = 'text';
    } else {
        e.target.classList.add('show');
        e.target.textContent = 'Mostrar';
        passwordInput3.type = 'password';
    }
});


/** Funcion activar menu */







/** para el ingreso de registros del admin */
(function(){
    window.addEventListener("load", () => {
        const uploader = document.getElementById('uploader');
        if (uploader == null){
            return;
        }
        uploader.addEventListener("dragover", e => {
            e.preventDefault();
            uploader.classList.add("over");
        });
        uploader.addEventListener("dragleave", e => {
            e.preventDefault();
            uploader.classList.remove("over");
        });

        uploader.addEventListener("drop", function (e) {
            e.preventDefault();
            uploader.classList.remove("over");
            // enviamos cada archivo al servidor...
            for (let i = 0; i < e.dataTransfer.files.length; i++) {
                const xhr = new XMLHttpRequest();
                
                let d=new Date();
                
                const data = new FormData();
                const time=d.getTime();
                sendFile(time, e.dataTransfer.files[i].name);
                var tamanio = e.dataTransfer.files[i].name.length;
                data.append('file', e.dataTransfer.files[i]);
                data.append('hola', 'true');
                data.append('time', time);
                xhr.open('POST', '/admin/upload/information', true);
                console.log(xhr);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            if (xhr.response) {

                                    uploadedFile(xhr.response, tamanio);
                                
                            }
                        } else {
                            console.error(xhr.statusText);
                            alert("Upload error!");
                        }
                    }
                }
                xhr.send(data);
            }
        });
    });

    const filesList=document.getElementById("filesList");

    /**
     * Funcion que se ejecuta cuando se envia el archivo
     * Añade el archivo a la lista de archivos enviados
     */
    function sendFile(time, fileName) {
        const div=document.createElement("div");
        div.dataset.time=time+fileName;
        div.classList.add("send");
        div.innerText=fileName;
        filesList.insertAdjacentElement("beforeend", div);
    }

    /**
     * Funcion que se ejecuta cuando el archivo ha sido recibido en el servidor
     * Marca el archivo como correcto o erroneo
     */
    function uploadedFile(data, tamanio) {
        let dataJ = data.substring(0,60+tamanio);
        dataJ=JSON.parse(dataJ);

        let el=document.querySelectorAll("[data-time='"+dataJ.time+dataJ.fileName+"']");
        if (el.length==0) {
            return;
        }
        el=el[el.length-1];
        el.classList.remove("send");
        if (dataJ.result==1) {
            el.classList.add("sended");
        } else {
            el.classList.add("error");
            console.error(dataJ.error);
        }
       // evenListener();
    }
    
})();

// const inputSave = document.getElementById("guardar-data-click");
// const filesListControl = document.getElementById("filesList");
// inputSave.addEventListener("click",clickDefault);
// function evenListener(){
//     const listadeArchivos = Array.from(filesListControl.children);
//     console.log(listadeArchivos[0].textContent);
    
//     if (listadeArchivos.length == 3 ){
//         if( listadeArchivos[0].textContent == "distributivoResultXML.json" &&
//         listadeArchivos[1].textContent == "Evidencia.json" &&
//         listadeArchivos[2].textContent == "ListaProfesores.json" ||
//         listadeArchivos[1].textContent == "distributivoResultXML.json" &&
//         listadeArchivos[2].textContent == "Evidencia.json" &&
//         listadeArchivos[0].textContent == "ListaProfesores.json" ||
//         listadeArchivos[2].textContent == "distributivoResultXML.json" &&
//         listadeArchivos[1].textContent == "Evidencia.json" &&
//         listadeArchivos[0].textContent == "ListaProfesores.json"
//         ){
//             inputSave.removeEventListener("click",clickDefault);
//             console.log("ahora si");
//         }
//     }
            
//  }
        

/* FUNCIONALIDAD DE MOSTRAR LAS TABLAS DE FORMA ASINCRONA */

(function(){

    const buttonListar = document.getElementById("listar-evidencias");
    //console.log(buttonListar);
    if(buttonListar == null){
        return;
    } 
    buttonListar.addEventListener("click",clickListar);

    /**
     * Damos el evento al boton de listar para empezar con presentacion de las evidencias de maner asincrona
     */

    function clickListar(e){
        e.preventDefault();
        // const httpRequest = new XMLHttpRequest();
        const selectedAnio = document.getElementById("anios");
        let valorSelectedAnio = selectedAnio.value;
        if(valorSelectedAnio == "#"){

        }else{
            getData({
                "method": 'GET',
                "url": `/data/evidences/asyn?anio=${valorSelectedAnio}`,
            });
        } 
    }

    /**
     * Esta funcion obtiene el resultado de la peticion de evidencias al servidor
     */
    let urlbefore  = "";  
    function getData({method,url,asyn=true}){
        const httpRequest = new XMLHttpRequest();
        if(urlbefore == url) return ;
        httpRequest.open(method,url,asyn);
        urlbefore = url;
        httpRequest.send(null);
        let count =0;
        httpRequest.onreadystatechange = function (){
            if(count == 0){
                if(httpRequest.status == 200){
                    const response =  JSON.parse(httpRequest.response);
                      localStorage.setItem("data", JSON.stringify(response));
                      pictureData();
                      count++;
                  }
            }
            
           
        }

    /**
     * Esta funcion renderiza la tabla extraida desde el servidor
     */
    const rows = 10;
    var cuuretPage = 1;
    const pageForData = document.getElementById("page-for-data");


       function pictureData(){
           let data = null;
           if(data == null){
            data = JSON.parse(localStorage.getItem("data")).result;
           }
           /** Aqui  */
           const tbody = document.querySelector("tbody");
           const tbodyChildern = Array.from(tbody.children);
           if(tbodyChildern.length != 0){
               tbodyChildern.forEach(tr => {
                   tr.remove();
               })
           }
           paginationforNumber(data, rows, cuuretPage);
           cuuretPage--;
           let start = rows * cuuretPage;
           let end = rows+start;
            data = data.slice(start, end);
           
           data.forEach(elements => {
               const tr = document.createElement("tr");
               tbody.append(tr);
              const td1 = document.createElement("td");
              const td2 = document.createElement("td");
              const td3 = document.createElement("td");
              const td4 = document.createElement("td");
              const td5 = document.createElement("td");
              const td6 = document.createElement("td");
              const td7 = document.createElement("td");
              const td8 = document.createElement("td");
              const input = document.createElement("input");
            td1.innerHTML = elements.nombre_criterio ;
            td2.innerHTML = elements.cod_estandar;
            td2.classList.add("text-center-td");
            td3.innerHTML = elements.cod_elemento;
            td3.classList.add("text-center-td");
            td4.innerHTML = elements.nombre_evidencia;
            td5.innerHTML = `<label for="pdf">
            <img src="/public/img/pdf1.svg" alt=".pdf" title="Clic aquí para subir un archivo.">
            </label><input type="file" id="pdf" name="pdf" accept=".pdf" />`;
            td6.innerHTML=`
            <label for="doc"><img src="/public/img/doc1.svg" alt=".doc" title="Clic aquí para subir un archivo.">
            </label><input type="file" id="doc" name="doc" accept=".doc" />
            `;
            td7.innerHTML = `
            <label for="xlsx"><img src="/public/img/xls1.svg" alt=".xlsx" title="Clic aquí para subir un archivo.">
            </label><input type="file" id="xlsx" name="xlsx" accept=".xlsx" />
            `;
            input.setAttribute("name",elements.cod_evidencia);
            input.style.display= "none";
            td8.innerHTML = "No entregado";
            tr.classList.add("bytb");
            tr.append(td1);
            tr.append(td2);
            tr.append(td3);
            tr.append(td4);
            tr.append(td5);
            tr.append(td6);
            tr.append(td7);
            tr.append(input);
            tr.append(td8);  
           })
           
       }

       function paginationforNumber(data, rows, page ){
           pageForData.innerHTML = "";
        let numbers = Math.ceil(data.length/rows);
        for (let i = 1; i <= numbers; i++) {
            let button = displayButton(i,page)
            pageForData.append(button);
        }

    }

       function displayButton(page, currentPage_for_data){
        const buttons = document.createElement("button");
        buttons.innerText = page;
        if(page == currentPage_for_data) buttons.classList.add("active");

        buttons.addEventListener("click", ()=>{
            cuuretPage = page;
            pictureData();
        } )
        

        return buttons;
        
    }

        
    }

    
   
    
   
  
    
})();

(function (){

    function update(){
    const getClassNumbers = document.getElementById('pages-for-data');
    if (getClassNumbers == null) return;
    const totalLength = Array.from(getClassNumbers.children);
    if(totalLength.length == 0){
        setTimeout(()=>{
            update();
        },500)
    }else{
        totalLength.forEach(a => {
            a.style.width = 50/totalLength.length+"rem";
        })
    }
    
    }

   update();
    
   

})();
