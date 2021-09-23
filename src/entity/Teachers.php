<?php

namespace entity;

class Teachers{
    public $ci_profesor;
    public $nombre_profesor;
    public $email_profesor;
    public $password_profesor;
    public $permission;
    const INGRESAR_EVIDENCIA= 1;
    const EDITAR_EVIDENCIA= 2;
    const ACTUALIZAR_EVIDENCIA= 4;
    const ELIMINAR_EVIDENCIA= 8;
    const ADMINSTRADOR = 16;
    
public function hashPermission($permission){
    return $this->permission & $permission;
}

}