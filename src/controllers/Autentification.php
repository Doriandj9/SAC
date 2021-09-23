<?php

namespace controllers;

class Autentification{
    private $profesorTable;
    private $email_profesor;
    private $password_profesor;

    public function __construct(\models\DataBaseTable $profesorTable, string $email_profesor, string $password_profesor)
    {
        $this->profesorTable= $profesorTable;
        $this->email_profesor= $email_profesor;
        $this->password_profesor= $password_profesor;
        session_start();
    }


    public function validation($email, $password){
        $result = $this->profesorTable->selectFromColumn('email_profesor', strtolower($email));
       
        if($result && password_verify($password,$result[0]->{$this->password_profesor})  ){
            session_regenerate_id();
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $result[0]->{$this->password_profesor};
                return true;
        }else{
            false;
        }
    }

    public function validationAll(){

        if(empty($_SESSION['email'])){
            return false;
        }
        
        $result = $this->profesorTable->selectFromColumn('email_profesor', $_SESSION['email'])[0];

        if($result->{$this->password_profesor} == $_SESSION['password']){
            return true;
        }else{
            return false;
        }
    }

}