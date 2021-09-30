<?php

namespace controllers;
class Admin{

    public function admin(){
       
        return [
            'title' => 'Administrador - SAC',
            'template' => 'admin/upload.html.php'
        ];
    }
    public function uploadInformation(){
        if (!isset($_FILES["file"]) or count($_FILES["file"])==0) {
            return "";
        }
        
        $carpetaMoverArchivos="public/records/";
        
        $source = $_FILES["file"]["tmp_name"];
        $fileName = $_FILES["file"]["name"];
        $destination = $carpetaMoverArchivos.$fileName;
      
        // comprovamos si ya existe el archivo.
        // comentar estas lineas si deseamos que se pueda sobreescribir
        // if (file_exists($destination)) {
        //     echo json_encode(["result"=>0, "time"=>$_POST["time"], "fileName"=>$fileName, "error"=>"el archivo ya existe"]);
        //     return;
        // }
        
        // por seguridad no permitimos archivos con extension .php
        $notAllowedExtension = ["php", "php3", "php4", "php4"];
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (in_array($ext, $notAllowedExtension)) {
            echo json_encode(["result"=>0, "time"=>$_POST["time"], "fileName"=>$fileName, "error"=>"extension no permitida"]);
            return;
        }   
        
        // movemos el archivo
        copy($source,$destination);
        if (move_uploaded_file($source, $destination)) {
            echo json_encode(["result"=>1, "time"=>$_POST["time"], "fileName"=>$fileName, "error"=>""]);
        } else {
            echo json_encode(["result"=>0, "time"=>$_POST["time"], "fileName"=>$fileName, "error"=>"no se ha podido mover el archivo"]);
        }
    }
    
    public function permiseActions(){

        $objetReflectio = new \ReflectionClass('\entity\Teachers');
        $permission = $objetReflectio->getConstants();

        if(isset($_GET['id'])){
            return [
                'title' => 'Editar Permisos',
                'template' => 'admin/editPermission.html.php',
                'variables' => [
                    'permissions' => $permission
                ]
            ];
        }else{
            return [
                'title' => 'Permisos de Acceso',
                'template' => 'admin/permiseaccess.html.php'
            ];
        }        
    }
}