<?php 

namespace web;

class Utiles{


    public static function  hashPassword(string $string): string
    {
        $password = password_hash($string, PASSWORD_DEFAULT);

        return $password;
    }

    public static function separateString(string $string): string
    {
        $array = explode(',',$string);
        $string = $array[0];
        $prueba= $array[0];
        foreach($array as $value){
            if($prueba != $value){
                    $string .= ', '. $value;             
            }
            $prueba = $value;
        }

        return $string;
    }

    public static  function  routeEncryte(string $route, string $element){
        $result = [];
        if($route == 'id'){
            $result['id']= 'KJ-TRF-IYTAQWSSA';
        }
        $elementDescompuesto = preg_split('/(?<=[0-9])/i',$element);
        $encrym = '';
        foreach($elementDescompuesto as $elemento){
            $utiles = new Utiles;
            $num =  intval($elemento);
            $encrym .= ''.$utiles->mesclador($num).'-';
        }

        $result['element'] = $encrym;

        return $result;

    }

    private function mesclador(string $num){
        $number = intval($num);
        $finalEncryp= 0;
        
            $number = $number+1*6;
            for ($i=0; $i < $number ; $i++){
                $finalEncryp += $finalEncryp + 1 +$number;
            }
        

        return $finalEncryp;
    }

    public static function descriptador($encryp){
        $encryp = rtrim($encryp,'-');
        $encrymSeparado = explode('-',$encryp);
        array_pop($encrymSeparado);
        $desencryp = '';
        foreach($encrymSeparado as $element){
            $utlis = new Utiles;
            $desencryp .= $utlis->tablaEncryp($element);
        }

        return $desencryp;


    }

    private function tablaEncryp($element){
        $descrip = '';
        match($element){
            '441' => $descrip='0',
            '1016' => $descrip='1',
            '2295' => $descrip='2',
            '5110' => $descrip='3',
            '11253' => $descrip='4',
            '24564' => $descrip='5',
            '53235' => $descrip='6',
            '114674' => $descrip='7',
            '245745' => $descrip='8',
            '524272' => $descrip='9',
            default => $descrip = 'error'            
        };

        return $descrip;
    }

    
}

