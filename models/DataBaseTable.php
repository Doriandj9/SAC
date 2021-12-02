<?php

namespace models;

class DataBaseTable
{
    private $pdo;
    private $table;
    private $primaryKey;
    private $password;
    private $className;
    private $arguments;

    public function __construct(
        \models\conection\Conection $pdo,
        string $table,
        string $primaryKey,
        string $className = '\stdClass',
        array $arguments = []
    ) {
        $this->pdo = $pdo->getConection();
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->className = $className;
        $this->arguments = $arguments;
    }

    private function runQuery($query, $params = [])
    {
        //    echo $query;
        //      var_dump($params);
        $result = $this->pdo->prepare($query);
        $result->execute($params);
        return $result;
    }
    private function inserDate($params)
    {
        foreach ($params as $key => $value) {
            if ($key instanceof \DateTime) {
                $params[$key] = $value->format('Y-m-d H:i:s');
            }
        }

        return $params;
    }
    private function addDate($params)
    {
        foreach ($params as $key => $value) {
            if ($key instanceof \DateTime) {
                $date = new \DateTime($value);
                $params[$key] = $date->format('Y-m-d');
            }
        }

        return $params;
    }

    private function createInsert($params, $trim = false)
    {

        $query = 'INSERT INTO ' . $this->table . ' (';

        foreach ($params as $key => $value) {
            $query .= '' . $key . ' ,';
        }

        $query = rtrim($query, ',');

        $query .= ') VALUES (';
        foreach ($params as $key => $value) {
            $query .= ':' . $key . ',';
        }

        $query = rtrim($query, ',');

        $query .= ')';




        return $query;
    }

    public function insert($params, $trim = false)
    {
        $params = $this->addDate($params);
        $query = $this->createInsert($params);
        if ($trim) {
            foreach ($params as $key => $value) {
                $params[$key] = trim($value);
            }
        }




        return $this->runQuery($query, $params);
    }

    public function selectFromColumn($column, $restrict)
    {

        $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $column . '= :' . $this->primaryKey;
        $params = [$this->primaryKey => $restrict];
        $result = $this->runQuery($query, $params);
        return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->arguments);
    }
    public function selectFromColumnSeparate($column, $restrict)
    {

        $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $column . '= :' . $column;
        $params = [$column => $restrict];

        $result = $this->runQuery($query, $params);

        return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->arguments);
    }

    public function select($limit = null, $offset = null, $orderBy = false, $column = null)
    {
        $query = 'SELECT * FROM ' . $this->table . ' ';

        if ($orderBy == true && $column != null) {
            $query .= ' ORDER BY ' . $column . ' ASC ';
        }

        if ($limit != null) {
            $query .= 'LIMIT ' . $limit;
        }

        if ($offset != null) {
            $query .= ' OFFSET ' . $offset;
        }

        $result = $this->runQuery($query);

        return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->arguments);
    }

    public function selectJoinFull()
    {
        $query = 'SELECT array_agg(nombre_criterio ORDER BY nombre_criterio)as nombre_criterio, nombre_evidencia, 
        array_agg(elemento_cod) as cod_elemento, 
        cod_evidencia, pdf_archivo, docx_archivo,
        array_agg(estandar_cod) as cod_estandar,
        xlxs_archivo FROM evidencia INNER JOIN 
        evidencia_elemento_fundamental 
        ON evidencia.cod_evidencia = evidencia_elemento_fundamental.evidencia_cod
        INNER JOIN elemento_fundamental ON evidencia_elemento_fundamental.elemento_cod = elemento_fundamental.cod_elemento
        INNER JOIN estandar ON elemento_fundamental.estandar_cod = estandar.cod_estandar
        INNER JOIN criterio ON estandar.criterio_cod = criterio.cod_criterio
        GROUP BY cod_evidencia 
        ORDER BY nombre_evidencia ';

        $result = $this->runQuery($query);
        return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->arguments);
    }

    public function update($params)
    {
        $params = $this->inserDate($params);
        $query = 'UPDATE ' . $this->table . ' SET ';
        foreach ($params as $key => $value) {
            $query .= '' . $key . '=:' . $key . ',';
        }

        $query = rtrim($query, ',');

        $query .= ' WHERE ' . $this->primaryKey . ' = :' . $this->primaryKey;
        $this->runQuery($query, $params);
    }


    public function updatePassword($params, $cod)
    {
        $query = 'UPDATE ' . $this->table . ' SET ';
        foreach ($params as $key => $value) {
            $query .= '' . $key . ' = :' . $key . ',';
        }

        $query = rtrim($query, ',');

        $query .= ' WHERE ' . $this->primaryKey . ' = :' . $this->primaryKey;
        var_dump($query);
        $params[$this->primaryKey] = $cod;

        $this->runQuery($query, $params);
    }

    public function getFullJoinCarrier()
    {
        $query = 'SELECT * FROM carrera_profesor INNER JOIN profesor 
        ON carrera_profesor.profesor_ci = profesor.ci_profesor INNER JOIN periodo academico 
        ON periodo academico.ci_profesor = profesor.ci_profesor INNER JOIN carrera_periodo academico
        ON carrera_periodo academico.academico_periodo_id = id_periodo_academico INNER JOIN carrera
        WHERE carrera.id_carrera = carrera_periodo academico.carrera_id AND carrera.id_carrera 
        =  carrera_profesor.carrera_id ';

        $result = $this->runQuery($query);
        return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->arguments);
    }
    public function getFullJoinCarrierForColumProfesorCi($value)
    {

        $query = 'SELECT * FROM profesor INNER JOIN carrera_profesor 
        ON profesor.id_profesor = carrera_profesor.profesor_id
        INNER JOIN carrera
        ON carrera.cod_carrera = carrera_profesor.carrera_cod
        WHERE profesor.id_profesor = :id_profesor';
        $stament = ['id_profesor' => $value];
        $result = $this->runQuery($query, $stament);

        return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->arguments);
    }

    public function getCountTable()
    {
        $query = 'SELECT COUNT(' . $this->primaryKey . ') FROM ' . $this->table . '';

        $result = $this->runQuery($query);

        return $result->fetch();
    }
}
