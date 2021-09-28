<?php 

namespace web;

use controllers\Autentification;

class ViewController implements \frame\WebRoutes{
    private $profesorTable;
    private $autentification;
    private $responsabilidadTable;
     
    public function __construct()
    {
        $this->profesorTable= new \models\DataBaseTable(new \models\conection\Conection(),
                                                        'profesor', 'ci_profesor','\entity\Teachers');
        $this->responsabilidadTable = new \models\DataBaseTable(new \models\conection\Conection(), 
                                                        'responsabilidad', 'cod_responsabilidad');
        $this->autentification = new \controllers\Autentification($this->profesorTable, 'email_profesor', 'password_profesor');
    }
    public function getRoutes(): array
    {

        $loginController = new \controllers\Login($this->autentification, $this->profesorTable);
        $homeController = new  \controllers\Home($this->autentification);
        $passwordController = new \controllers\Password(); 
        $teachersController = new  \controllers\Teachers();
        
            return [
            '' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'homeLogin'
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'verifyLogin'
                ]
                ],

        'home' => [
            'GET' => [
                'controller' => $homeController,
                'action' => 'home'
            ],
            
            'login' => true
            ],

            'entry/evidences' => [
                'GET' => [
                    'controller' => $teachersController,
                    'action' => 'ingreso'
                ],
                'POST' => [
                    'controller' => $teachersController,
                    'action' => 'ingreso'
                ]
                ],

            'show/evidences' => [
                'GET' => [
                    'controller' => $teachersController,
                    'action' => 'evidencias'
                ],
                'POST' => [
                    'controller' => $teachersController,
                    'action' => 'evidencias'
                ]
                ],

            'generate/reports' => [
                'GET' => [
                    'controller' => $teachersController,
                    'action' => 'reportes'
                ],
                'POST' => [
                    'controller' => $teachersController,
                    'action' => 'reportes'
                ]
                ],

            'change/password' => [
                'GET' => [
                    'controller' => $passwordController,
                    'action' => 'password'
                ],
                'POST' => [
                    'controller' => $passwordController,
                    'action' => 'password'
                ]
                ],
            'exit' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'logout'
                ]
            ]
        ];
    }

    public function getAutentification(): Autentification
    {
        return $this->autentification;
    }

    public function getResponsability(): array
    {
        $user = $this->autentification->getUser();
        $responsabilidad = $this->responsabilidadTable->selectFromColumn('profesor_ci',$user->ci_profesor);
        return $responsabilidad ? $responsabilidad: [];
        // if($responsabilidad){
        //     return $responsabilidad;
        // }else{
        //     return [];
        // }
            
    }
}