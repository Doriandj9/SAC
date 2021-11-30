<?php 

namespace web;

class Utiles{


    public function hashPassword($string): string
    {
        $password = password_hash($string, PASSWORD_DEFAULT);

        return $password;
    }

    
}