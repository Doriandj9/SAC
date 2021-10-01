<?php 

namespace web;

use controllers\Autentification;

class ViewController implements \frame\WebRoutes{
    private $profesorTable;
    private $autentification;
    private $responsabilidadTable;
    private $evidencesTable;
    private $criterioTable;
    private $estandarTable;
    private $elementoFundamentalTable;
    private $evidencia_elementoFundamentalTable;
     
    public function __construct()
    {
        $this->profesorTable= new \models\DataBaseTable(new \models\conection\Conection(),
                                                        'profesor', 'ci_profesor','\entity\Teachers',[&$this->responsabilidadTable]);
        $this->responsabilidadTable = new \models\DataBaseTable(new \models\conection\Conection(), 
                                                        'responsabilidad', 'cod_responsabilidad');
                                                        $this->evidencesTable = new \models\DataBaseTable( new \models\conection\Conection(),
                                                        'evidencia', 'cod_evidencia' 
    );
        $this->criterioTable = new \models\DataBaseTable(
            new \models\conection\Conection(), 'criterio', 'cod_criterio'
        );
        $this->estandarTable= new \models\DataBaseTable(
            new \models\conection\Conection(), 'estandar', 'cod_estandar'
        );
        $this->elementoFundamentalTable= new \models\DataBaseTable(
            new \models\conection\Conection(), 'elemento fundamental','cod_elemento'
        );
        $this->evidencia_elementoFundamentalTable= new \models\DataBaseTable(
            new \models\conection\Conection(), 'evidencia_elemento fundamental', 'evidencia_cod'
        );
        $this->autentification = new \controllers\Autentification($this->profesorTable, 'email_profesor', 'password_profesor');

        
    }
    public function getRoutes(): array
    {

        $loginController = new \controllers\Login($this->autentification, $this->profesorTable);
        $homeController = new  \controllers\Home($this->autentification);
        $passwordController = new \controllers\Password(); 
        $teachersController = new  \controllers\Teachers($this->evidencesTable);
        $adminController = new \controllers\Admin($this->profesorTable,
                                                    $this->evidencesTable,
                                                    $this->criterioTable,
                                                    $this->estandarTable,
                                                    $this->elementoFundamentalTable,
                                                    $this->evidencia_elementoFundamentalTable
                                                );
        $evaluatorController = new \controllers\Evaluator();
        $controllerAsyJ = new \controllers\AsynJavaScript($this->evidencesTable);
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
                    'action' => 'guardar'
                ],

                'login' => true,
                ],

            'show/evidences' => [
                'GET' => [
                    'controller' => $teachersController,
                    'action' => 'evidencias'
                ],
                'POST' => [
                    'controller' => $teachersController,
                    'action' => 'evidencias'
                ],
                
                'login' => true
                ],

            'generate/reports' => [
                'GET' => [
                    'controller' => $teachersController,
                    'action' => 'reportes'
                ],
                'POST' => [
                    'controller' => $teachersController,
                    'action' => 'reportes'
                ],
                'login' => true
                ],

            'change/password' => [
                'GET' => [
                    'controller' => $passwordController,
                    'action' => 'password'
                ],
                'POST' => [
                    'controller' => $passwordController,
                    'action' => 'password'
                ],
                'login' => true
                ],
            'exit' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'logout'
                ]
                ],
                'admin/upload/information' => [
                    'GET' => [
                        'controller' => $adminController,
                        'action' => 'admin'
                    ],
                    'POST' => [
                        'controller' => $adminController,
                        'action' => 'uploadInformation'
                    ],
                    'login' => true,
                    'permission' => \entity\Teachers::ADMINSTRADOR
                    ],
                'admin/permises/access' => [
                    'GET' => [
                        'controller' => $adminController,
                        'action' => 'permiseActions'
                    ],
                    'login' => true,
                    'permission' => \entity\Teachers::ADMINSTRADOR
                    ],
                'admin/data/save' => [
                    'POST' => [
                        'controller' => $adminController,
                        'action' => 'saveDataDataBase'
                    ],
                    'login' => true,
                    'permission' => \entity\Teachers::ADMINSTRADOR
                    ],
                'evaluation/evidences'=> [
                    'GET' => [
                        'controller' => $evaluatorController,
                        'action' => 'evaluator'
                    ],
                    'login' => true,
                    'responsability' => \web\Responsability::EVALUADOR
                    ],
                'data/evidences/asyn' => [
                    'GET' => [
                        'controller' => $controllerAsyJ,
                        'action' => 'loadData'
                    ],
                ]
        ];
    }

    public function getAutentification(): Autentification
    {
        return $this->autentification;
    }

    public function hashPermission($permission): bool
    {
        $user = $this->autentification->getUser();
        return $user->hashPermission($permission) ? true: false;
    }

    public function hashResponsability($responsability): bool
    {
        $user = $this->autentification->getUser();
        return $user->hashResponsability($responsability) ? true: false;
    }
}