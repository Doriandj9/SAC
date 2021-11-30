<?php

namespace controllers;

class Home{
private $autentificaction;

public function __construct(\controllers\Autentification $autentificaction)
{
    $this->autentificaction= $autentificaction;
}

    public function home(){
       
        return [
            'title' => 'Sistema de Aseguramiento de la Calidad',
            'template' => 'home/home.html.php'
        ];
    }
    
}