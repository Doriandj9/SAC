<?php
namespace frame;

class EntryPoint{
    private $route;
    private $method;
    private $viewController;

    public function __construct(string $route, string $method , \web\ViewController $viewController)
    {
        $this->route= $route;
        $this->method= $method;
        $this->viewController= $viewController;
        $this->verifyUrl();
    }

    private function verifyUrl(){
        if($this->route != strtolower($this->route)){
            http_response_code(301);
            header('location: '.strtolower($this->route));
        }
    }

    private function loadTemplate($template, $variables =[]){
        extract($variables);
        ob_start();
        include __DIR__ . '/../../views/'. $template;
        return ob_get_clean();
    }

    public function run(){
        $array = $this->viewController->getRoutes();
        $controller = $array[$this->route][$this->method]['controller'];
        $action = $array[$this->route][$this->method]['action'];
        $result = $controller->$action();
        $title = $result['title'];
        if(isset($array[$this->route]['login']) && !$this->viewController->getAutentification()->validationAll()){
            header('location: /');
        }else{

            if(isset($result['login'])){
                if(isset($result['variables'])){
                    $content = $this->loadTemplate($result['template'], $result['variables']);
                }else{
                    $content = $this->loadTemplate($result['template']);
                }
                
                echo  $this->loadTemplate('templates/layoutlogin.html.php', [
                    'title' => $title,
                    'content' => $content
                ]); 
            }else{
                if(isset($result['variables'])){
                    $content = $this->loadTemplate($result['template'], $result['variables']);
                }else{
                    $content = $this->loadTemplate($result['template']);
                }
                $user = $this->viewController->getAutentification()->getUser();
                $responsabilidad = $this->viewController->getResponsability();
                echo $this->loadTemplate('templates/layout.html.php', [
                    'title' => $title,
                    'content' => $content,
                    'user' => $user,
                    'responsabilidad' => $responsabilidad
                ]);
    
            }
        }
        
        

    }
}

