<?php 

namespace web;

class ViewController implements \frame\WebRoutes{
    public function getRoutes(): array
    {

        $loginController = new \controllers\Login();
        return [
            '' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'homeLogin'
                ]
            ]
        ];
    }
}