<?php

    include __DIR__ .'/vendor/autoload.php';

try{
    $route = ltrim(strtok($_SERVER['REQUEST_URI'],'?'),'/');
    echo "hola";
    echo "Como estas";

}catch(\PDOException $e){

}