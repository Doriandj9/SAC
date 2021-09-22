<?php 

namespace web;

class ViewController implements \frame\WebRoutes{
    public function getRoutes(): array
    {

        $loginController = new \controllers\Login();
        $homeController = new  \controllers\Home();
        $teachersController = new  \controllers\Teachers();

            return [
            '' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'homeLogin'
                ]
                ],

        'home' => [
            'GET' => [
                'controller' => $homeController,
                'action' => 'home'
            ],
            'POST' => [
                'controller' => $homeController,
                'action' => 'home'
            ]
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
                    'controller' => $teachersController,
                    'action' => 'actualizarClave'
                ],
                'POST' => [
                    'controller' => $teachersController,
                    'action' => 'actualizarClave'
                ]
                ],
        ];
    }

}