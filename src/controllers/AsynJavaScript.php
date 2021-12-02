<?php 
namespace controllers;

class AsynJavaScript{
    private $evidenciasTable;

    public function __construct(
        \models\DataBaseTable $evidenciasTable
    )
    {
        $this->evidenciasTable= $evidenciasTable;
    }

    public function loadData(){
        $result  = $this->evidenciasTable->selectJoinFull();
        $prueba = [];
        foreach($result as $value){

            $nombre = rtrim($value->nombre_criterio,'}');
            $nombre = ltrim($nombre,'{');
            $nombre = str_replace('"','',$nombre);
            $nombre = \web\Utiles::separateString($nombre);  
            $elemento = rtrim($value->cod_elemento,'}');
            $elemento = ltrim($elemento,'{');
            $elemento = \web\Utiles::separateString($elemento);
            $standar = rtrim($value->cod_estandar,'}');
            $standar = ltrim($standar,'{');
            $standar = \web\Utiles::separateString($standar);
            $prueba[] = [
                'nombre_criterio' => $nombre,
                'nombre_evidencia' => $value->nombre_evidencia,
                'cod_elemento' => $elemento,
                'cod_evidencia' => $value->cod_evidencia,
                'pdf_archivo' => $value->pdf_archivo,
                'docx_archivo'=> $value->docx_archivo,
                'cod_estandar' => $standar,
                'xlxs_archivo' => $value->xlxs_archivo
            ];
             
        }

        $asysResultreturn = [
            "result" => $prueba
        ];
        echo json_encode($asysResultreturn,JSON_UNESCAPED_UNICODE);
        die;
    }
}