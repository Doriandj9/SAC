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
        $asysResultreturn = [
            "result" => $result
        ];
        echo json_encode($asysResultreturn,JSON_UNESCAPED_UNICODE);
        die;
    }
}