<?php 

namespace app\core;

class App extends Router {
	public function addApp(string $req, string $controller, string $view, array $options = []): void {
		$route = compact('req', 'controller', 'view', 'options');
		$this->addRoute($route);
	}

	public function render():void {

		$route = $this->getRoute();

		$route['options']['css'] = $this->defineStyles($route);

		$path = 'app\\controllers\\';
		$class = $route['controller'];

		if(!class_exists(($path.$class)))
		{
			echo 'Class não encontrada...';
			die;
		}

		new ($path.$class)($route);

	}

	private function defineStyles( array $listStyles ):string {

		$tag = "";


		foreach($listStyles['options']['css'] as $style){
			$tag .= <<<MYText
				<link rel="stylesheet" href="./src/css/{$style}.css">
			MYText;
		}

		return $tag;
	}
}

