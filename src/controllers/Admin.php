<?php

namespace controllers;
class Admin{

    private $profesoresTable;
    private $evidenciasTable;
    public function __construct(\models\DataBaseTable $profesoresTable, \models\DataBaseTable $evidenciasTable)
    {
        $this->profesoresTable= $profesoresTable;
        $this->evidenciasTable= $evidenciasTable;
    }

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
        $notAllowedExtension = ["php", "php3", "php4", "php5"];
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

    public function saveDataDataBase(){
        if(isset($_POST['guardar'])){
            // $dataEvidencias = file_get_contents('./public/records/Evidencia.json');
            // $arrayDataEvidencias = json_decode($dataEvidencias, true)['EVIDENCIAS'];
            // foreach($arrayDataEvidencias as $value){
            //     $data = [
            //         'cod_evidencia' => $value['codigo'],
            //         'nombre_evidencia' => $value['nombreEvidencia']
            //     ];
            //     $this->evidenciasTable->insert($data);
            //    echo $value['codigo']. "<br>";
            //    echo $value['nombreEvidencia']. "<br> <br> <br>";
            // }
            $dataListadoProfesores = file_get_contents('./public/records/ListaProfesores.json');
            $arrayLista = json_decode($dataListadoProfesores, true)['lista'];

            foreach($arrayLista as $value){

                $data2 = [
                    'ci_profesor' => $value['ci_profesor'],
                    'nombre_profesor' => $value['nombre_profesor'],
                    'email_profesor' => 
                    strtolower(substr(preg_replace('/(.+?)( )(.+?)/i', '$1$3', $value['nombre_profesor']),0,15)). "@ueb.edu.ec",
                    'password_profesor' => password_hash($value['ci_profesor'], PASSWORD_DEFAULT) 
                ];

                $this->profesoresTable->insert($data2);
                echo $data2['email_profesor']. "<br>";
                echo $data2['nombre_profesor']. "<br><br><br>";
            }

           header('location: /');
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