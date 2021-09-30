/*funcion para  correo */

let correo_institucional = document.getElementById("email_institucional");


correo_institucional.addEventListener("input",ingreso);

// function ingreso(){
//     const form = document.getElementById("form-login");
//     console.log(correo_institucional.value);
//     let expre = /[a-z0-9]/g;
//     if(!expre.test(correo_institucional.value)){
//         let div = document.createElement("div");
//         div.className ="div-error";
//         div.innerHTML = `<p> Error no es un correo insticuional </p>`;
//         //form.append(div);
       
        
//     }

    
// }