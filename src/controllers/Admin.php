<?php

namespace controllers;

class Admin{

    public function home(){
       
        return [
            'title' => 'Administrador - SAC',
            'template' => 'admin/upload.html.php'
        ];
    }
    
}