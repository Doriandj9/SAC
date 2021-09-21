<?php

namespace controllers;

class Login{


    public function homeLogin(){
        return [
            'title' => 'Sistema de Aseguramiento de la Calidad',
            'login' => true,
            'template' => 'home/login.html.php'
        ];
    }

    
}