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
                
                data.append('time', time);
                xhr.open('POST', '/admin/upload/information', true);
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
        evenListener();
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
        


function LoadDadta(){
    let httpRequest = new XMLHttpRequest();
    const xhr = new XMLHttpRequest();
    httpRequest.open('GET', '/data/evidences/asyn', true);
    httpRequest.send(null);

    httpRequest.onreadystatechange= function () {
        console.log(httpRequest.status);
        console.log(httpRequest.response);
        const res = JSON.parse(httpRequest.response)
        console.log(res);
    }

    
}

LoadDadta();
