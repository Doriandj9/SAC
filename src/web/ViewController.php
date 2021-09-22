<?php 

namespace web;

class ViewController implements \frame\WebRoutes{
    public function getRoutes(): array
    {

        $loginController = new \controllers\Login();
        $homeController = new  \controllers\Home();
        $passwordcontroller = new \controllers\Password(); 
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
            ]
            ],

            'ingreso' => [
                'GET' => [
                    'controller' => $homeController,
                    'action' => 'ingreso'
                ],
                'POST' => [
                    'controller' => $homeController,
                    'action' => 'ingreso'
                ]
                ],

                'change/password' => [
                    'GET' => [
                        'controller' => $passwordcontroller,
                        'action' => 'password'
                    ],
                    'POST' => [
                        'controller' => $passwordcontroller,
                        'action' => 'password'
                    ]
                    ],
        ];
    }

}