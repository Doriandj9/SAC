<?php

namespace controllers;

class Password{

    private $profesorTable;
    private $authentication;

    public function __construct(\models\DataBaseTable $profesorTable,
                                \controllers\Autentification $authentication)
    {
        $this->profesorTable= $profesorTable;
        $this->authentication = $authentication;
    }

    public function password(){
        $user = $this->authentication->getUser();

        return [
            'title' => 'Cambio de clave - SAC',
            'template' => 'teachers/changepassword.html.php',
            'variables' => [
                'usuario' => $user
            ]
        ];
    }

    public function updatePassword(){
        $user = $this->authentication->getUser();
        
        if(isset($_POST['password'])){
            $pwd = $_POST['password'];
            $newpwd = password_hash($_POST['passwordnew'],PASSWORD_DEFAULT);

            if(password_verify($pwd,$user->password_profesor)){
                if($_POST['passwordnew'] == $_POST['passwordnew1']){
                    $params = [
                        'password_profesor' => $newpwd
                    ];
                    $_SESSION['password'] = $newpwd;
                    $this->profesorTable->updatePassword($params, $_POST['cod']);
                    header('location: /home');
                }else{
                    return [
                        'title' => 'Cambio de clave - SAC',
                        'template' => 'teachers/changepassword.html.php',
                        'variables' => [
                            'usuario' => $user,
                            'error' => 'La nueva contraseña no coinciden, por favor verifice y vuelva a intentarlo.'
                        ]
                    ];
                }
                
            }else{
                return [
                    'title' => 'Cambio de clave - SAC',
                    'template' => 'teachers/changepassword.html.php',
                    'variables' => [
                        'usuario' => $user,
                        'error' => 'La contraseña actual no es la correcta, por favor vuelva a intentarlo.'
                    ]
                ];
            }
        
        }
    }
   
}