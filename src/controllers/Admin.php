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


        if(isset($_GET['id'])){
            return [
                'title' => 'Editar Permisos',
                'template' => 'admin/editPermission.html.php'
            ];
        }else{
            return [
                'title' => 'Permisos de Acceso',
                'template' => 'admin/permiseaccess.html.php'
            ];
        }        
    }
}