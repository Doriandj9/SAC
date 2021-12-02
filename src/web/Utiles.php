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

    
}