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

        $objetReflectio = new \ReflectionClass('\entity\Teachers');
        $permission = $objetReflectio->getConstants();

        if(isset($_GET['id'])){
            return [
                'title' => 'Editar Permisos',
                'template' => 'admin/editPermission.html.php',
                'variables' => [
                    'permissions' => $permission
                ]
            ];
        }else{
            return [
                'title' => 'Permisos de Acceso',
                'template' => 'admin/permiseaccess.html.php'
            ];
        }        
    }
}