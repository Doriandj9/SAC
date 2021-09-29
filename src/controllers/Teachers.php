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

    public function actualizarClave(){
        return [
            'title' => 'Actualización de clave - SAC',
            'template' => 'teachers/cambioclave.html.php'
        ];
    }

    public function guardar(){
        if(isset($_FILES['file']['pdf']['name'])){
            $archivo = (file_get_contents($_FILES['file']['pdf']['tmp_name']));
        $params = [
            'pdf_archivo' => $archivo
        ];
        $this->evidencesTable->update($params ,  $_POST['cod'],);
        }
        
       // header('location:/');
    }
}