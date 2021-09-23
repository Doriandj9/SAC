<?php

namespace controllers;

class Login{
private $autenticaction;

public function __construct(\controllers\Autentification $autenticaction)
{
    $this->autenticaction= $autenticaction;
}

    public function homeLogin(){
        return [
            'title' => 'Sistema de Aseguramiento de la Calidad',
            'login' => true,
            'template' => 'home/login.html.php'
        ];
    }

    public function verifyLogin(){
        $result = $this->autenticaction->validation($_POST['email'], $_POST['password']);
        if($result){
            header('location: /home');
        }

    }

    
}