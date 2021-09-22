<?php

namespace controllers;

class Home{


    public function home(){
        return [
            'title' => 'Sistema de Aseguramiento de la Calidad',
            'template' => 'home/home.html.php'
        ];
    }

    public function ingreso(){
        return [
            'title' => 'Ingreso de evidencias - SAC',
            'template' => 'teachers/ingreso.html.php'
        ];
    }

    
}