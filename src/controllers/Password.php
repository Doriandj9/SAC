<?php

namespace controllers;

class Password{

    public function __construct(\models\DataBaseTable $evidencesTable)
    {
        $this->evidencesTable= $evidencesTable;
    }

    public function password(){
        return [
            'title' => 'Cambio de clave - SAC',
            'template' => 'teachers/changepassword.html.php'
        ];
    }

    public function updatePassword(){
        if(isset($_POST['password']['name'])){
            $pwd = $_POST['password']['name'];
        $params = [
            'password_profesor' => $pwd
        ];
        $this->teacherTable->updatePassword($params ,  $_POST['cod'],);
        }
    }
   
}