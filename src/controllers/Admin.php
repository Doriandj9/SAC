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

    public function saveDataDataBase()
    {
        if (isset($_POST['guardar'])) {
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
            // $dataListadoProfesores = file_get_contents('./public/records/ListaProfesores.json');
            // $arrayLista = json_decode($dataListadoProfesores, true)['lista'];

            // foreach($arrayLista as $value){

            //     $data2 = [
            //         'ci_profesor' => $value['ci_profesor'],
            //         'nombre_profesor' => $value['nombre_profesor'],
            //         'email_profesor' => 
            //         strtolower(substr(preg_replace('/(.+?)( )(.+?)/i', '$1$3', $value['nombre_profesor']),0,15)). "@ueb.edu.ec",
            //         'password_profesor' => password_hash($value['ci_profesor'], PASSWORD_DEFAULT) 
            //     ];

            //     $this->profesoresTable->insert($data2);
            //     echo $data2['email_profesor']. "<br>";
            //     echo $data2['nombre_profesor']. "<br><br><br>";
            // }

            // $dataCriterio = file_get_contents('./public/records/criterios.json');
            // $arrayCriterio = json_decode($dataCriterio, true)['criterios'];

            //  foreach($arrayCriterio as $value){

            //     $data3 = [
            //         'cod_criterio' => $value['codigo'],
            //         'nombre_criterio' => $value['nombre']
            //     ];

            //     $this->criterioTable->insert($data3);
            // }
            // $dataEstandares = file_get_contents('./public/records/estandares.json');
            //     $arrayEstandar = json_decode($dataEstandares, true)['ESTANDARES'];

            //     foreach($arrayEstandar as $value){

            //         $data4 = [
            //             'cod_estandar' => $value['codigo'],
            //             'nombre_estandar' => $value['nombre'],
            //             'criterio_cod' => $value['criterio']
            //         ];
            //         $this->estandarTable->insert($data4);
            //     }
            // $dataElementosFundamentales = file_get_contents('./public/records/elementos.json');
            //     $arrayElementofun = json_decode($dataElementosFundamentales, true)['ELEMENTO'];

            //     foreach($arrayElementofun as $value){

            //         $data5 = [
            //             'cod_elemento' => $value['codigo'],
            //             'nombre_elemento' => $value['nombre'],
            //             'estandar_cod' => $value['estandar']
            //         ];
            //         $this->elementoFundamentalTable->insert($data5);
            //     }

            $dataElementosFundamentales_Evidencias = file_get_contents('./public/records/entregablesF.json');
            $arrayElementofun_Evidencia = json_decode($dataElementosFundamentales_Evidencias, true)['elementosF'];

            foreach ($arrayElementofun_Evidencia as $value) {

                foreach ($value['elementos'] as $element) {
                    $data6 = [
                        'evidencia_cod' => $value['codigoE'],
                        'elemento_cod' => $element,
                    ];
                    $this->evidencia_elementoFundamentalTable->insert($data6);
                }
            }
        }

        header('location: /');
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

    public function loadInformation()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        if (!is_int($page)) {
            $page = intval($page, 10);
        }
        $offset = ($page - 1) * 15;
        $count = $this->evidenciasTable->getCountTable();
        $evidences = $this->evidenciasTable->select(15, $offset);
        return [
            'title' => 'Permisos de Acceso',
            'template' => 'admin/loadInformation.html.php',
            'variables' => [
                'evidences' => $evidences,
                'page' => $page,
                'count' => $count
            ]
        ];
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


    public function saveInformation()
    {
        var_dump($_POST);
        $array = $_POST;
        date_default_timezone_set('America/Guayaquil');
        foreach ($array as $value) {

            if (
                $value['dateI'] != ''
                && $value['timeI'] != ''
                && $value['dateF'] != ''
                && $value['timeF'] != ''
                && $value['cod'] != ''
            ) {
                $data = [
                    'fecha_inicio' => $value['dateI'] . " " . $value['timeI'],
                    'fecha_fin' => $value['dateF'] . " " . $value['timeF'],
                    'cod_evidencia' => $value['cod']
                ];
                $this->evidenciasTable->update($data);
            }
        }

        header('location: /admin/load/information');
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
        $this->profesoresTable->insert($coordinadorData);
        $this->profesor_responsabilidadTable->insert($responsabilidad_profesorData);
        $this->carrera_profesorTable->insert($carrera_profesor_data);
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
