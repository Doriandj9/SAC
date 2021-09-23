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
            'title' => 'SAC',
            'login' => true,
            'template' => 'home/login.html.php'
        ];
    }

    public function verifyLogin(){
        $result = $this->autenticaction->validation($_POST['email'], $_POST['password']);
        if($result){
            header('location: /home');
        }else{
            return[
                'title' => 'SAC',
                'login' => true,
                'template' => 'home/login.html.php',
                'variables' => [
                    'error' => 'Correo electrónico y/o contraseña incorrectos. Por favor vuelva a intentarlo.'
                ]
                ];
        }

    }

    public function logout(){
        unset($_SESSION);
        session_destroy();
        header('location:/');
    }

    
}