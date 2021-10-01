<?php



 $xml = file_get_contents('./DatosAIngresar/data/elemento5.xml');
 $StringXml = simplexml_load_string($xml);
$result = json_encode($StringXml, JSON_UNESCAPED_UNICODE);
file_put_contents('./DatosAIngresar/data/elemento5.json',$result);
// $_NEWARRAY = [];
// function separarJson($json){
//     $array = json_decode($json, true)['distributivo'];
//     $_NEWARRAY[] = [
//         'ci_profesor' => $array[0]['cedula'],
//                     'nombre_profesor' => $array[0]['nombresyApellidos']
//     ];
//     foreach($array as $key => $value){
//             if(isset($value['cedula']) &&  verify($_NEWARRAY, $value['cedula']) ){

//                 array_push($_NEWARRAY, [
//                     'ci_profesor' => $value['cedula'],
//                     'nombre_profesor' => $value['nombresyApellidos']
//                 ]);
                
//             }
            
        

        
//     }
//     file_put_contents('./DatosAIngresar/ListaProfesores.json', json_encode($_NEWARRAY,  JSON_UNESCAPED_UNICODE));
    
// }
// function verify($cedula0,$cedula):bool
//    {

//     return $cedula0 == $cedula ? true: false;
        // foreach($_NEWARRAY as $key=> $value){
        //     if($value['ci_profesor'] != $cedula){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }
 //  }

//$json = file_get_contents('./DatosAIngresar/distributivoResultXML.json');

//separarJson($json);

// function deleteA(){
//     $arrayJ = json_decode(file_get_contents('./DatosAIngresar/ListaProfesores.json'), true);
//     var_dump($arrayJ[0+1]['ci_profesor']);
//     for($i=0; $i <= count($arrayJ); $i++){
//         if(verify($arrayJ[$i]['ci_profesor'],$arrayJ[$i+1]['ci_profesor'])){
//             unset($arrayJ[$i]);  
//         }
//         $arrayJ = $arrayJ;
//     }

//     file_put_contents('./DatosAIngresar/ListaProfesores.json', json_encode($arrayJ,JSON_UNESCAPED_UNICODE));
// }

// $nombre = "ALBAN GALLO MANUEL EDUARDO";
// $nombreRecortado = str_split($nombre,10);
// //$nombreRecortado= $nombreRecortado[0]. "ueb.";

// //echo $nombreRecortado;
// $unido = preg_replace('/(.+?)( )(.+?)/i', '$1$3', $nombre);
// $nuevo = strtolower($unido);
// var_dump($unido);
// $recort= substr($nuevo,0,15);
// echo $recort. "@ueb.edu.ec";