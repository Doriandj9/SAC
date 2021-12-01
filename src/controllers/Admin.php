<?php

namespace controllers;

use function PHPSTORM_META\type;

class Admin
{

    private $profesoresTable;
    private $evidenciasTable;
    private $criterioTable;
    private $estandarTable;
    private $elementoFundamentalTable;
    private $evidencia_elementoFundamentalTable;
    private $facultadTable;
    private $carreraTable;
    private $periodoTable;
    private $profesor_responsabilidadTable;
    private $carrera_periodo_academicoTable;
    private $carrera_profesorTable;

    public function __construct(
        \models\DataBaseTable $profesoresTable,
        \models\DataBaseTable $evidenciasTable,
        \models\DataBaseTable $criterioTable,
        \models\DataBaseTable $estandarTable,
        \models\DataBaseTable $elementoFundamentalTable,
        \models\DataBaseTable $evidencia_elementoFundamentalTable,
        \models\DataBaseTable $facultadTable,
        \models\DataBaseTable $carreraTable,
        \models\DataBaseTable $periodoTable,
        \models\DataBaseTable $profesor_responsabilidadTable,
        \models\DataBaseTable $carrera_periodo_academicoTable,
        \models\DataBaseTable $carrera_profesorTable
        
    ) {
        $this->profesoresTable = $profesoresTable;
        $this->evidenciasTable = $evidenciasTable;
        $this->criterioTable = $criterioTable;
        $this->estandarTable = $estandarTable;
        $this->elementoFundamentalTable = $elementoFundamentalTable;
        $this->evidencia_elementoFundamentalTable = $evidencia_elementoFundamentalTable;
        $this->facultadTable = $facultadTable;
        $this->carreraTable = $carreraTable;
        $this->periodoTable = $periodoTable;
        $this->profesor_responsabilidadTable = $profesor_responsabilidadTable;
        $this->carrera_periodo_academicoTable = $carrera_periodo_academicoTable;
        $this->carrera_profesorTable = $carrera_profesorTable;
    }

    public function admin()
    {

        return [
            'title' => 'Administrador - SAC',
            'template' => 'admin/upload.html.php'
        ];
    }
    public function uploadInformation()
    {

        if (!isset($_FILES["file"]) or count($_FILES["file"]) == 0) {
            return "";
        }

        $carpetaMoverArchivos = "public/records/";

        $source = $_FILES["file"]["tmp_name"];
        $fileName = $_FILES["file"]["name"];
        $destination = $carpetaMoverArchivos . $fileName;



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
            echo json_encode(["result" => 0, "time" => $_POST["time"], "fileName" => $fileName, "error" => "extension no permitida"]);
            return;
        }

        // movemos el archivo
        if (move_uploaded_file($source, $destination)) {
            echo json_encode(["result" => 1, "time" => $_POST["time"], "fileName" => $fileName, "error" => ""]);
        } else {
            echo json_encode(["result" => 0, "time" => $_POST["time"], "fileName" => $fileName, "error" => "no se ha podido mover el archivo"]);
        }
        die;
    }


    public function permiseActions()
    {

        $objetReflectio = new \ReflectionClass('\entity\Teachers');
        $permission = $objetReflectio->getConstants();
        $teachers = $this->profesoresTable->select();

        if (isset($_GET['id'])) {
            $teacher = $this->profesoresTable->selectFromColumn('id_profesor', $_GET['id'])[0];
            return [
                'title' => 'Editar Permisos',
                'template' => 'admin/editPermission.html.php',
                'variables' => [
                    'permissions' => $permission,
                    'teacher' => $teacher
                ]
            ];
        } else {
            return [
                'title' => 'Permisos de Acceso',
                'template' => 'admin/permiseaccess.html.php',
                'variables' => [
                    'teachers' => $teachers
                ]
            ];
        }
    }

    public function loadCoordinator()
    {
        $carreras = $this->carreraTable->select();
        $periodo = $this->periodoTable->select();
        return [
            'title' => 'Ingresar Coodinador',
            'template' => 'admin/loadCoordinator.html.php',
            'variables' => [
                'carreras' => $carreras,
                'periodo' => $periodo
            ]
        ];
    }


    
    public function loadPeriod()
    {
        return [
            'title' => 'Ingresar Coodinador',
            'template' => 'admin/loadPeriod.html.php'
        ];
    }
    public function saveCoordinator()
    {
        $password = new \web\Utiles;
        $coordinadorData = [
            'id_profesor' => $_POST['cedula'],
            'nombre_profesor' => $_POST['nombres'],
            'email_profesor' => $_POST['email'],
            'password_profesor' =>  $password->hashPassword($_POST['cedula']),
            'periodo_academico_id' => $_POST['periodo']
        ];
        $responsabilidad_profesorData = [
            'profesor_id' => $_POST['cedula'],
            'responsabilidad_cod' => 1
        ];
        $carrera_profesor_data = [
            'profesor_id' => $_POST['cedula'],
            'carrera_cod' => $_POST['carrera']
        ];
        try{
            $this->profesoresTable->insert($coordinadorData);
        $this->profesor_responsabilidadTable->insert($responsabilidad_profesorData);
        $this->carrera_profesorTable->insert($carrera_profesor_data);
        }catch(\PDOException $e){
            
        }
        
        header('location: /admin/load/coordinator');
    }
    public function savePeriod()
    {
        $periodoData = [
            'id_periodo_academico' => $_POST['cedula'],
            'fecha_inicial' => $_POST['fechaInicio'],
            'fecha_final' => $_POST['fechaFinal'],
            'descripcion' => $_POST['descripcion']
        ];
        $this->periodoTable->insert($periodoData);
        header('location: /admin/save/period');
    }

    public function loadCarrier()
    {
        $facultades = $this->facultadTable->select();
        $carreras = $this->carreraTable->select();
        $periodo = $this->periodoTable->select();
        return [
            'title' => 'Ingresar Coodinador',
            'template' => 'admin/loadCarrier.html.php',
            'variables' => [
                'facultades' => $facultades,
                'carreras' => $carreras,
                'periodo' => $periodo
            ]
        ];
    }

    public function saveCarrier()
    {
        $carreraData = [
            'cod_carrera' => $_POST['cod-carrera'],
            'nombre_carrera' => $_POST['nombre-carrera'],
            'facultad_id' => $_POST['facultad']
        ];
        $carrera_periodo_academicoData = [
            'carrera_cod' => $_POST['cod-carrera'],
            'academico_periodo_id' => $_POST['periodo']
        ];
        $this->carreraTable->insert($carreraData);
        $this->carrera_periodo_academicoTable->insert($carrera_periodo_academicoData);

        header('location: /admin/load/carrier');
    }
}
