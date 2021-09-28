<?php

namespace controllers;

class Teachers{
    private $evidencesTable;

    public function __construct(\models\DataBaseTable $evidencesTable)
    {
        $this->evidencesTable= $evidencesTable;
    }

    public function ingreso(){
        $evidences = $this->evidencesTable->select();
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
        var_dump($_FILES);
    }
}