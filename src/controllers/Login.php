<?php

namespace controllers;

class Login{
private $autenticaction;
private $profesorTable;
public function __construct(\controllers\Autentification $autenticaction, \models\DataBaseTable $profesorTable)
{
    $this->autenticaction= $autenticaction;
    $this->profesorTable= $profesorTable;
}

    public function homeLogin(){
        $passwordHash= password_hash('2100702667', PASSWORD_DEFAULT);
        $paras = [    
            'ci_profesor' => '0250666666',
            'nombre_profesor' => 'Denis',
            'email_profesor' => 'denis@gmail.com',
            'password_profesor' => $passwordHash,
            'permission' => 16
        ];
    //    $this->profesorTable->insert($paras);
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