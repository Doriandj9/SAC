<?php

namespace controllers;

class Coordinator
{
  private  $evidenciasTable;
  private $profesoresTable;
  private $responsabilidadTable;
  private $profesor_responsabilidadTable;
  private $authentification;
  private $carrera_profesorTable;
  private $criterioTable;
  private $estandarTable;
  private $elementoFundamentalTable;
  private $evidencia_elementoFundamentalTable;

  public function __construct(
    \models\DataBaseTable $evidenciasTable,
    \models\DataBaseTable $profesoresTable,
    \models\DataBaseTable $responsabilidadTable,
    \models\DataBaseTable $profesor_responsabilidadTable,
    \controllers\Autentification $authentification,
    \models\DataBaseTable $carrera_profesorTable,
    \models\DataBaseTable $criterioTable,
    \models\DataBaseTable $estandarTable,
    \models\DataBaseTable $elementoFundamentalTable,
    \models\DataBaseTable $evidencia_elementoFundamentalTable,

  ) {
    $this->evidenciasTable = $evidenciasTable;
    $this->profesoresTable = $profesoresTable;
    $this->responsabilidadTable = $responsabilidadTable;
    $this->profesor_responsabilidadTable = $profesor_responsabilidadTable;
    $this->authentification = $authentification;
    $this->carrera_profesorTable = $carrera_profesorTable;
    $this->criterioTable = $criterioTable;
    $this->estandarTable = $estandarTable;
    $this->elementoFundamentalTable = $elementoFundamentalTable;
    $this->evidencia_elementoFundamentalTable = $evidencia_elementoFundamentalTable;
  }
  // Devuelve una vista para ingresar los documentos necesarios para el SAC
  public function coordinator()
  {

    return [
      'title' => 'Coordinación - SAC',
      'template' => 'coordinator/upload.html.php'
    ];
  }
  // Devuelve las evidencias guardadas en la base de datos, paginadas
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
      'template' => 'coordinator/loadInformation.html.php',
      'variables' => [
        'evidences' => $evidences,
        'page' => $page,
        'count' => $count
      ]
    ];
  }
  // Guardar la informacion con las fechas de entrega y finalizacion de las evidencias
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

  // 
  public function saveDataDataBase()
  {

    // $evidences = $this->saveEvidences();
    // if (!$evidences) {
    $this->uploadInformation();

    if (isset($_POST['option'])) {
      match ($_POST['option']) {
        '#saveFile__DtrI' => $this->verifyData($this->saveEvidences()),
        '#saveFile__ListDI' => $this->verifyData($this->saveTeacher()),
        '#saveFile__CrtI' => $this->verifyData($this->saveCriterion()),
        '#saveFile__EstI' => $this->verifyData($this->saveStandard()),
        '#saveFile__ElmI' => $this->verifyData($this->saveElementFundamental()),
        '#saveFile__ElmeI' => $this->verifyData($this->saveElementFundamentalEvidences()),
        'default' => $this->saveError()
      };
      // if ($_POST['option'] == "#saveFile__DtrI"){
      //   $evidences = $this->saveEvidences();
      //   $this->verifyData($evidences);
      // }else if($_POST['option'] == "#saveFile__ListDI"){
      //   $teachers = $this->saveTeacher();
      //   $this->verifyData($teachers);
      // }
    }
    die;
    // } else {
    //   echo json_encode($evidences);
    // }
    // header('location: /');
  }

  private function saveError()
  {
    echo json_encode([
      'error' => "No hay datos para ingresar"
    ]);
  }

  private function verifyData($result)
  {
    if (!$result) {
      echo json_encode([
        'result' => "No hubo errores en el ingreso de datos"
      ]);
    } else {
      echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
  }

  private function uploadInformation()
  {
    if (!isset($_FILES["file"]) or count($_FILES["file"]) == 0) {
      return "";
    }

    $carpetaMoverArchivos = "public/records/";

    $source = $_FILES["file"]["tmp_name"];
    $fileName = $_FILES["file"]["name"];
    $destination = $carpetaMoverArchivos . $fileName;

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
  }
  private function saveEvidences()
  {
    $dataEvidencias = file_get_contents('./public/records/Evidencia.json');
    $arrayDataEvidencias = json_decode($dataEvidencias, true)['EVIDENCIAS'];
    $errors = [];
    foreach ($arrayDataEvidencias as $value) {
      $data = [
        'cod_evidencia' => $value['codigo'],
        'nombre_evidencia' => $value['nombreEvidencia']
      ];
      try {
        $this->evidenciasTable->insert($data);
      } catch (\PDOException $e) {
        $errors[] = [
          'error' => $e
        ];
      }
    }
    if (count($errors) > 0) {
      return $errors;
    } else {
      return false;
    }
  }

  private function saveTeacher()
  {
    $dataListadoProfesores = file_get_contents('./public/records/ListaProfesores.json');
    $arrayLista = json_decode($dataListadoProfesores, true)['lista'];
    $user = $this->authentification->getUser();
    $userData = $user->getUserDataTable()[0]->cod_carrera;

    $errors = [];
    foreach ($arrayLista as $value) {

      $data2 = [
        'id_profesor' => $value['ci_profesor'],
        'nombre_profesor' => $value['nombre_profesor'],
        'email_profesor' =>
        strtolower(substr(preg_replace('/(.+?)( )(.+?)/i', '$1$3', $value['nombre_profesor']), 0, 15)) . "@ueb.edu.ec",
        'password_profesor' => password_hash($value['ci_profesor'], PASSWORD_DEFAULT),
        'periodo_academico_id' => $value['periodo_academico']
      ];

      $data3 = [
        'profesor_id' => $value['ci_profesor'],
        'carrera_cod' => $userData
      ];

      try {
        $this->profesoresTable->insert($data2);
        $this->carrera_profesorTable->insert($data3);
      } catch (\PDOException $e) {
        $errors[] = [
          'error' => $e
        ];
      }
    }
    if (count($errors) > 0) {
      return $errors;
    } else {
      return false;
    }
  }

  private function saveCriterion()
  {
    $dataCriterio = file_get_contents('./public/records/criterios.json');
    $arrayCriterio = json_decode($dataCriterio, true)['criterios'];

    $errors = [];
    foreach ($arrayCriterio as $value) {

      $data3 = [
        'cod_criterio' => $value['codigo'],
        'nombre_criterio' => $value['nombre']
      ];

      try {
        $this->criterioTable->insert($data3);
      } catch (\PDOException $e) {
        $errors[] = [
          'error' => $e
        ];
      }
    }
    if (count($errors) > 0) {
      return $errors;
    } else {
      return false;
    }
  }

  private function saveStandard()
  {
    $dataEstandares = file_get_contents('./public/records/estandares.json');
    $arrayEstandar = json_decode($dataEstandares, true)['ESTANDARES'];
    $errors = [];
    foreach ($arrayEstandar as $value) {

      $data4 = [
        'cod_estandar' => $value['codigo'],
        'nombre_estandar' => $value['nombre'],
        'criterio_cod' => $value['criterio']
      ];
      try {
        $this->estandarTable->insert($data4);
      } catch (\PDOException $e) {
        $errors[] = [
          'error' => $e
        ];
      }
     
    }
    if (count($errors) > 0) {
      return $errors;
    } else {
      return false;
    }
  }

  private function saveElementFundamental()
  {
    $dataElementosFundamentales = file_get_contents('./public/records/elementos.json');
    $arrayElementofun = json_decode($dataElementosFundamentales, true)['ELEMENTO'];
    $errors = [];
    foreach ($arrayElementofun as $value) {

      $data5 = [
        'cod_elemento' => $value['codigo'],
        'nombre_elemento' => $value['nombre'],
        'estandar_cod' => $value['estandar']
      ];
      try {
        $this->elementoFundamentalTable->insert($data5);
      } catch (\PDOException $e) {
        $errors[] = [
          'error' => $e
        ];
      }
    }
    if (count($errors) > 0) {
      return $errors;
    } else {
      return false;
    }
  }

  private function saveElementFundamentalEvidences()
  {
    $dataElementosFundamentales_Evidencias = file_get_contents('./public/records/entregablesF.json');
    $arrayElementofun_Evidencia = json_decode($dataElementosFundamentales_Evidencias, true)['elementosF'];
    $errors = [];
    foreach ($arrayElementofun_Evidencia as $value) {

      foreach ($value['elementos'] as $element) {
        $data6 = [
          'evidencia_cod' => $value['codigoE'],
          'elemento_cod' => $element,
        ];
        try {
          $this->evidencia_elementoFundamentalTable->insert($data6);
        } catch (\PDOException $e) {
          $errors[] = [
            'error' => $e
          ];
        }    
      }
    }
    if (count($errors) > 0) {
      return $errors;
    } else {
      return false;
    }
  }

}
