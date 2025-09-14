<?php 

namespace app\core;

use app\core\trait\TraitRouter;

class Router extends Request{
    private array $routes = [];

    public function __construct()
    {
        parent::__construct();
    }

    protected function addRoute(array $route): void {
        
        if(!isset($route['req']) || empty($route['req'])){
            echo "A rota é obrigátoria.";
            die;
        }

        if(!isset($route['view']) || empty($route['view'])){
            echo "A view é obrigátoria.";
            die;
        }

        if(!isset($route['controller']) || empty($route['controller'])){
            echo "O controller é obrigátorio";
            die;
        }

        
        if(array_key_exists($route['req'], $this->routes)){
            echo 'Essa rota já existe.';
            die;
        }

        $route['view'] = "../app/views/".$route['view'].'.phtml';
        $route['html'] = '../app/views/layouts/html.phtml';

        $this->routes[$route['req']] = $route; 

    }

    protected function getRoute(): array
    {
        $route = $this->routes[$this->uri()] ?? null;

        if(is_null($route)){
            echo 'Essa rota não existe';
            die;
        }

        return $route;
    }


}