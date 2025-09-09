<?php 

namespace app\routers;

class App {
    private string $req;

    private array $routes = [];

    public object $route;

    public Css $css;

    public function __construct()
    {
        $this->defineUri();
    }

    private function defineUri(): void{

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $uri = explode('/', $uri)[1];
        
        $this->req = '/'.$uri;


    }

    private function findRoute(string $req, string $methodRequest): ?object {

        $select = $this->routes[$req] ?? null;

        if(is_null($select)) return $select;

        if($select->methodRequest !== $methodRequest) return null;

        return $select;

    }

    private function defineRoute(): void {

        $route = $this->findRoute($this->req, $_SERVER['REQUEST_METHOD']);

        if(is_null($route)){
            echo 'Essa rota não existi';
            exit;
        }

        $this->css = new Css($route->options->css);

        $this->route = $route;
    }

    private function addRoute(string $req, string $view, array $options, string $methodRequest): array {

        $route = $this->findRoute($req, $methodRequest);

        if(!is_null($route))return [false, 'Está rota já existi...'];

        $this->routes[$req] = (object) [
            'req' => $req,
            'view' => $view,
            'methodRequest' => $methodRequest,
            'options' => (object) $options
        ];

        return [true, 'Rota adicionada com sucesso'];
    }

    public function get($req, $view, $options = []): void {

        [$status, $info] = $this->addRoute($req, $view, $options, 'GET');

        if(!$status){

            echo $info;

            exit;

        }

    }

    public function init():void {
        $this->defineRoute();
    }
}