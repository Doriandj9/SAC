<?php 

namespace web;

use controllers\Autentification;

class ViewController implements \frame\WebRoutes{
    private $profesorTable;
    private $passwordUpdate;
    private $autentification;
    private $responsabilidadTable;
    private $evidencesTable;
    private $criterioTable;
    private $estandarTable;
    private $elementoFundamentalTable;
    private $evidencia_elementoFundamentalTable;
    private $carrera_profesorTable;
    private $profesor_responsabilidad;
    private $facultadTable;
    private $carreraTable;
    private $periodoTable;
    private $carrera_periodo_academicoTable;

     
    public function __construct()
    {
        $this->profesorTable= new \models\DataBaseTable(new \models\conection\Conection(),
                                                        'profesor', 'id_profesor', '\entity\Teachers',[
                                                            &$this->responsabilidadTable,
                                                            &$this->carrera_profesorTable,
                                                            &$this->profesor_responsabilidad
                                                        ]);
        $this->responsabilidadTable = new \models\DataBaseTable(new \models\conection\Conection(), 
                                                        'responsabilidad', 'cod_responsabilidad');
        $this->evidencesTable = new \models\DataBaseTable( new \models\conection\Conection(),
                                                        'evidencia', 'cod_evidencia');
        $this->passwordUpdate = new \models\DataBaseTable( new \models\conection\Conection(),
                                                        'profesor', 'password_profesor');
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
        $this->facultadTable= new \models\DataBaseTable(
            new \models\conection\Conection, 'facultad','id_facultad'
        );
        $this->carreraTable= new \models\DataBaseTable(
            new \models\conection\Conection, 'carrera','cod_carrera'
        );
        $this->carrera_profesorTable= new \models\DataBaseTable(
            new \models\conection\Conection(), 'carrera_profesor', 'carrera_id'
        );
        $this->profesor_responsabilidad= new \models\DataBaseTable(
            new \models\conection\Conection(),
            'profesor_responsabilidad','profesor_id'
        );
        $this->carrera_periodo_academicoTable= new \models\DataBaseTable(
            new \models\conection\Conection, 'carrera_periodo_academico','carrera_cod'
        );
        $this->periodoTable= new \models\DataBaseTable(
            new \models\conection\Conection, 'periodo_academico','id_periodo_academico'
        );
        $this->autentification = new \controllers\Autentification($this->profesorTable, 'email_profesor', 'password_profesor');

        
    }
    public function getRoutes(): array
    {

        $loginController = new \controllers\Login($this->autentification, $this->profesorTable);
        $homeController = new  \controllers\Home($this->autentification);
        $passwordController = new \controllers\Password($this->profesorTable, $this->autentification);
        $teachersController = new  \controllers\Teachers($this->evidencesTable);
        $adminController = new \controllers\Admin($this->profesorTable,
                                                    $this->evidencesTable,
                                                    $this->criterioTable,
                                                    $this->estandarTable,
                                                    $this->elementoFundamentalTable,
                                                    $this->evidencia_elementoFundamentalTable,
                                                    $this->facultadTable,
                                                    $this->carreraTable,
                                                    $this->periodoTable,
                                                    $this->profesor_responsabilidad,
                                                    $this->carrera_periodo_academicoTable,
                                                    $this->carrera_profesorTable,
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
                ],
                'all' => true
                ],

        'home' => [
            'GET' => [
                'controller' => $homeController,
                'action' => 'home'
            ],
            'login' => true,
            'all' => true
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
                    'action' => 'updatePassword'
                ],
                'login' => true,
                'all' => true
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
                    // 'POST' => [
                    //     'controller' => $adminController,
                    //     'action' => 'uploadInformation'
                    // ],
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
                'admin/load/information' =>[
                    'GET' => [
                        'controller' => $adminController,
                        'action' => 'loadInformation'
                    ],
                    'POST' => [
                        'controller' => $adminController,
                        'action' => 'saveInformation'
                    ],
                    'login' => true,
                    'permission' => \entity\Teachers::ADMINSTRADOR
                ],
                'admin/save/period' =>[
                    'GET' => [
                        'controller' => $adminController,
                        'action' => 'loadPeriod'
                    ],
                    'POST' => [
                        'controller' => $adminController,
                        'action' => 'savePeriod'
                    ],
                    'login' => true,
                    'permission' => \entity\Teachers::ADMINSTRADOR
                ],
                'admin/load/coordinator' =>[
                    'GET' => [
                        'controller' => $adminController,
                        'action' => 'loadCoordinator'
                    ],
                    'POST' => [
                        'controller' => $adminController,
                        'action' => 'saveCoordinator'
                    ],
                    'login' => true,
                    'permission' => \entity\Teachers::ADMINSTRADOR
                ],
                'admin/load/carrier' =>[
                    'GET' => [
                        'controller' => $adminController,
                        'action' => 'loadCarrier'
                    ],
                    'POST' => [
                        'controller' => $adminController,
                        'action' => 'saveCarrier'
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
        if(!$user){
            return false;
        }
        return $user->hashPermission($permission) ? true: false;
    }

    public function hashResponsability($responsability): bool
    {
        $user = $this->autentification->getUser();
        if(!$user){
            return false;
        }
        return $user->hashResponsability($responsability) ? true: false;
    }
}