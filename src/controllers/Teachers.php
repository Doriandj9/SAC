<?php

namespace controllers;

class Teachers{


    public function ingreso(){
        return [
            'title' => 'Ingreso de evidencias - SAC',
            'template' => 'teachers/ingreso.html.php'
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

    
}