<?php

namespace models\conection;

include __DIR__ . '/../../config.php';

class Conection{
    private $pdo;

    public function getConection(){
        $this->pdo = new \PDO('mysql:host=localhost;setchar=utf8;dbname='.DBNAME,USER,PASSWORD);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $this->pdo;
    }
}