<?php 

namespace app\controllers;

class Register {
	public string $view;
	public string $styles;

	public function __construct(array $app)
	{
		$this->main($app);
	}

	private function main(array $app):void {
		$this->view = $app['view'];
		$this->styles = $app['options']['css'];
		require_once $app['html'];
	}
}