<?php

namespace controllers;

class Password{


    public function password(){
        return [
            'title' => 'Cambio de clave - SAC',
            'template' => 'teachers/changepassword.html.php'
        ];
    }
   
}