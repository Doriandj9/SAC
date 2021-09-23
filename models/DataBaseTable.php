<?php

namespace models;

class DataBaseTable{
    private $pdo;
    private $table;
    private $primaryKey;
    private $className;
    private $arguments;

    public function __construct(\models\conection\Conection $pdo, string $table,
                                    string $primaryKey, string $className='\stdClass',
                                    array $arguments=[]
                                )
    {
        $this->pdo= $pdo->getConection();
        $this->table= $table;
        $this->primaryKey= $primaryKey;
        $this->className= $className;
        $this->arguments= $arguments;

    }

    private function runQuery($query, $params=[]){

        $result= $this->pdo->prepare($query);
        $result->execute($params);
        return $result;

    }

    private function addDate($params){
        foreach($params as $key=> $value){
            if($key instanceof \DateTime){
                $date = new \DateTime($value);
                $params[$key] = $date->format('Y-m-d');
            }
        }

        return $params;
    }

    private function createInsert($params){
        $query = 'INSERT INTO `' . $this->table . '` (';

        foreach($params as $key=> $value){
            $query .= '`' . $key . '` ,';
        }

        $query = rtrim($query, ',');

        $query .= ') VALUES (';

        foreach ($params as $key=> $value){
            $query .= ':' . $key . ','; 
        }

        $query = rtrim($query, ',');

        $query .= ')';

        return $query;
    }

    public function insert($params){
        $params = $this->addDate($params);
        $query = $this->createInsert($params);

        $this->runQuery($query, $params);
    }

    public function selectFromColumn($column, $restrict){

        $query = 'SELECT * FROM `'. $this->table . '` WHERE `'. $column . '= :'. $this->primaryKey;
        $params = [ $this->primaryKey => $restrict ];

        $result = $this->runQuery($query, $params);
        return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->arguments);
    }

    public function select(){
        $query = 'SELECT * FROM `' . $this->table. '` ';
        $result = $this->runQuery($query);
        return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->arguments);
    }
    
}