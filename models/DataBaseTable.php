<?php

namespace models;

class DataBaseTable{
    private $pdo;
    private $table;
    private $primaryKey;
    private $password;
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
       //echo $query;
        // var_dump($params);
        $result= $this->pdo->prepare($query);
        $result->execute($params);
        return $result;

    }
    private function inserDate($params){
        foreach($params as $key=> $value){
            if($key instanceof \DateTime){
                $params[$key] = $value->format('Y-m-d H:i:s');
            }
        }

        return $params;
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
        
       return $this->runQuery($query, $params);
    }

    public function selectFromColumn($column, $restrict){

        $query = 'SELECT * FROM `'. $this->table . '` WHERE `'. $column . '`= :'. $this->primaryKey;
        $params = [ $this->primaryKey => $restrict ];

        $result = $this->runQuery($query, $params);
        return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->arguments);
    }

    public function select($limit = null, $offset =null){
        $query = 'SELECT * FROM `' . $this->table. '` ';

        if($limit != null){
            $query .= 'LIMIT '. $limit;
        }

        if($offset !=null){
            $query .= ' OFFSET ' . $offset;
        }
        $result = $this->runQuery($query);
        
        return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->arguments);
    }
   
    public function selectJoinFull(){
        $query = 'SELECT `nombre_criterio`,`cod_estandar`,
        GROUP_CONCAT(`cod_elemento`) as `cod_elemento`, `nombre_evidencia`, `cod_evidencia`, `pdf_archivo`, `docx_archivo`, `xlxs_archivo`
          FROM `evidencia` INNER JOIN `evidencia_elemento fundamental` 
        ON `evidencia_cod` = `cod_evidencia` INNER JOIN `elemento fundamental` ON
        `elemento_cod` = `cod_elemento` INNER JOIN `estandar` ON `estandar_cod` = `cod_estandar`
        INNER JOIN `criterio` WHERE `criterio_cod` = `cod_criterio`
        GROUP BY `nombre_evidencia` ORDER BY `cod_criterio`
        ';
        $result = $this->runQuery($query);
        return $result->fetchAll(\PDO::FETCH_CLASS,$this->className, $this->arguments);
    }

    public function update($params){
        $params = $this->inserDate($params);
        $query = 'UPDATE `'. $this->table . '` SET ';
        foreach($params as $key => $value){
            $query .= '`'. $key . '`=:' . $key . ',' ;
        }

        $query= rtrim($query, ',');

        $query .= ' WHERE `'. $this->primaryKey .'` = :' . $this->primaryKey;
        $this->runQuery($query, $params);
    }


    public function updatePassword($params, $cod){
        $query = 'UPDATE `'. $this->table . '` SET ';
        foreach($params as $key => $value){
            $query .= '`'. $key . '` = :' . $key . ',' ;
        }

        $query= rtrim($query, ',');

        $query .= ' WHERE `'. $this->primaryKey .'` = :' . $this->primaryKey;
        var_dump($query);
        $params[$this->primaryKey] = $cod;
        var_dump($params);
        $this->runQuery($query, $params);
        
    }

    public function getFullJoinCarrier(){
        $query = 'SELECT * FROM `carrera_profesor` INNER JOIN `profesor` 
        ON `carrera_profesor`.`profesor_ci` = `profesor`.`ci_profesor` INNER JOIN `periodo academico` 
        ON `periodo academico`.`ci_profesor` = `profesor`.`ci_profesor` INNER JOIN `carrera_periodo academico`
        ON `carrera_periodo academico`.`academico_periodo_id` = `id_periodo_academico` INNER JOIN `carrera`
        WHERE `carrera`.`id_carrera` = `carrera_periodo academico`.`carrera_id` AND `carrera`.`id_carrera` 
        =  `carrera_profesor`.`carrera_id` ';
        $result = $this->runQuery($query);
        return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->arguments);
    }
    public function getFullJoinCarrierForColumProfesorCi($value){
        $query = 'SELECT * FROM `carrera_profesor` INNER JOIN `profesor` 
        ON `carrera_profesor`.`profesor_ci` = `profesor`.`ci_profesor` INNER JOIN `periodo academico` 
        ON `periodo academico`.`ci_profesor` = `profesor`.`ci_profesor` INNER JOIN `carrera_periodo academico`
        ON `carrera_periodo academico`.`academico_periodo_id` = `id_periodo_academico` INNER JOIN `carrera`
        WHERE `carrera`.`id_carrera` = `carrera_periodo academico`.`carrera_id` AND `carrera`.`id_carrera` 
        =  `carrera_profesor`.`carrera_id`  AND `profesor`.`ci_profesor` ='. $value;
        $result = $this->runQuery($query);
        return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->arguments);
    }

    public function getCountTable(){
        $query = 'SELECT COUNT(`'. $this->primaryKey.'`) FROM `'. $this->table.'`';

        $result = $this->runQuery($query);
        
        return $result->fetch();
    
    }
}