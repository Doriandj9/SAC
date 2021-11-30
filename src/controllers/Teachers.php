<?php

namespace controllers;

class Teachers{
    private $evidencesTable;

    public function __construct(\models\DataBaseTable $evidencesTable)
    {
        $this->evidencesTable= $evidencesTable;
    }

    public function ingreso(){
        $evidences = $this->evidencesTable->selectJoinFull();
        return [
            'title' => 'Ingreso de evidencias - SAC',
            'template' => 'teachers/ingreso.html.php',
            'variables' => [
                'evidences' => $evidences
            ]
        ];
    }

    public function evidencias(){
        return [
            'title' => 'Listado de evidencias - SAC',
            'template' => 'teachers/evidencias.html.php'
        ];
    }

    public function reportes(){
        return [
            'title' => 'Gernerar reportes - SAC',
            'template' => 'teachers/reportes.html.php'
        ];
    }

    public function guardar(){
        if(isset($_FILES['pdf']['name'])){
            $archivo = $_FILES['pdf']['name'];
        $params = [
            'pdf_archivo' => $archivo
        ];
        $this->evidencesTable->update($params ,  $_POST['cod'],);
        }
        
       // header('location:/');
    }
}