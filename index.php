<?php

    include __DIR__ .'/vendor/autoload.php';

try{
    $route = ltrim(strtok($_SERVER['REQUEST_URI'],'?'),'/');
    $entryPoint = new \frame\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \web\ViewController());
    $entryPoint->run();
    
}catch(\PDOException $e){
    $title = "ERROR DATABASE";
    $content = "ERROR: ". $e->getMessage() . " in " . $e->getFile() . " : " . $e->getLine();
    var_dump($content);
    include __DIR__ .'/views/templates/layout.html.php';
}