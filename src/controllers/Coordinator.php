<?php
namespace controllers;

class Coordinator{
  private  $evidenciasTable;
  private $profesoresTable;
  private $responsabilidadTable;
  private $profesor_responsabilidadTable;

  public function __construct(
      \models\DataBaseTable $evidenciasTable,
      \models\DataBaseTable $profesoresTable,
      \models\DataBaseTable $responsabilidadTable,
      \models\DataBaseTable $profesor_responsabilidadTable
  )
  {
      $this->evidenciasTable= $evidenciasTable;
      $this->profesoresTable= $profesoresTable;
      $this->responsabilidadTable= $responsabilidadTable;
      $this->profesor_responsabilidadTable= $profesor_responsabilidadTable;
  }

  
}