<?php

namespace entity;

class Teachers{
    public $ci_profesor;
    public $nombre_profesor;
    public $email_profesor;
    public $password_profesor;
    public $permission;
    private $responsabilidadTable;
    const INGRESAR_EVIDENCIA= 1;
    const EDITAR_EVIDENCIA= 2;
    const ACTUALIZAR_EVIDENCIA= 4;
    const ELIMINAR_EVIDENCIA= 8;
    const ADMINSTRADOR = 16;

    public function __construct(\models\DataBaseTable $responsabilidadTable)
    {
        $this->responsabilidadTable= $responsabilidadTable;
    }

    public function getResponsability(){
        $responsabilidad = $this->responsabilidadTable->selectFromColumn('profesor_ci',$this->ci_profesor);
        return $responsabilidad ? $responsabilidad: [];
    }

    public function hashPermission($permission){
        return $this->permission & $permission;
    }

    public function hashResponsability($responsability){
        $responsabilidades = $this->responsabilidadTable->selectFromColumn('profesor_ci', $this->ci_profesor)[0];
        return $responsabilidades->nombre_responsabilidad == $responsability ? true : false;
}

}