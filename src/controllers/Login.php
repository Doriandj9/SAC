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
        $passwordHash= password_hash('nathy123', PASSWORD_DEFAULT);
        $paras = [
            'ci_profesor' => '0202468831',
            'nombre_profesor' => 'nataly',
            'email_profesor' => 'natalyfer@gmail.com',
            'password_profesor' => $passwordHash
        ];
       //$this->profesorTable->insert($paras);
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