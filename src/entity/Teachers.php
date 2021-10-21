<?php

namespace entity;

class Teachers{
    public $id_profesor;
    public $nombre_profesor;
    public $email_profesor;
    public $password_profesor;
    public $permission;
    private $responsabilidadTable;
    private $carrera_profesorTable;
    private $dataThe_carrera_profesorTable;
    private $profesor_responsabilidad;
    const INGRESAR_EVIDENCIA= 1;
    const EDITAR_EVIDENCIA= 2;
    const ACTUALIZAR_EVIDENCIA= 4;
    const ELIMINAR_EVIDENCIA= 8;
    const ADMINSTRADOR = 16;

    public function __construct(\models\DataBaseTable $responsabilidadTable,
                                \models\DataBaseTable $carrera_profesorTable,
                                \models\DataBaseTable $profesor_responsabilidad
    )
    {
        $this->responsabilidadTable= $responsabilidadTable;
        $this->carrera_profesorTable= $carrera_profesorTable;
        $this->profesor_responsabilidad= $profesor_responsabilidad;
    }

    public function getResponsability(){
        $responsabilidad = $this->profesor_responsabilidad->selectFromColumn('profesor_id',$this->id_profesor);
        return $responsabilidad ? $responsabilidad: [];
    }

    public function hashPermission($permission){
        return $this->permission & $permission;
    }

    public function hashResponsability($responsability){
        $responsabilidades = $this->profesor_responsabilidad->selectFromColumn('profesor_id', $this->id_profesor);
        if(!$responsabilidades){
            return false;
        }
            return $responsabilidades[0]->nombre_responsabilidad == $responsability ? true : false;
        
}

    public function getUserDataTable(){
        if($this->dataThe_carrera_profesorTable == null){
          $this->dataThe_carrera_profesorTable =  $this->carrera_profesorTable->getFullJoinCarrierForColumProfesorCi($this->id_profesor);
        }
        return $this->dataThe_carrera_profesorTable;
    }

}