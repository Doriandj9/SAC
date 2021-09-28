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
<<<<<<< HEAD
        $passwordHash= password_hash('0202123691', PASSWORD_DEFAULT);
=======

        $passwordHash= password_hash('2100702667', PASSWORD_DEFAULT);
>>>>>>> 88f89f78e7ceb2699d2e19ade3bf05b9a61b31c8
        $paras = [    
            'ci_profesor' => '0202123691',
            'nombre_profesor' => 'Jerson',
            'email_profesor' => 'jerchimbo@mailes.ueb.edu.ec',
            'password_profesor' => $passwordHash,
            'permission' => ''
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