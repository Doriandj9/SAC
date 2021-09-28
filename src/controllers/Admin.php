<?php

namespace controllers;

class Admin{

    public function home(){
       
        return [
            'title' => 'Administrador - SAC',
            'template' => 'admin/upload.html.php'
        ];
    }
    public function permiseActions(){

        return [
            'title' => 'Administrador - SAC',
            'template' => 'admin/permiseaccess.html.php'
        ];


    }
}