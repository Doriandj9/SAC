<?php 

namespace web;

class ViewController implements \frame\WebRoutes{
    public function getRoutes(): array
    {

        $loginController = new \controllers\Login();
        $homeController = new  \controllers\Home();
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
        ];
    }

}