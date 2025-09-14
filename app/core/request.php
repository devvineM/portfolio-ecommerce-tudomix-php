<?php 

namespace app\core;

class Request {

	private string $uri;
	private array $query = [];
	private array $body = [];

	public function __construct()
	{
		$this->setUri();
		$this->setQuery();
	}

	private function setUri(): void 
	{

		$uri = $_SERVER['REQUEST_URI'];

		$uri = parse_url($uri, PHP_URL_PATH);

		$uri = '/'.(explode('/', $uri)[1]);

		$this->uri = $uri;

	}

	private function setQuery():void 
	{
		$query = $_GET;

		$this->query = (array) $query;
	}

	private function setBody(): void 
	{
		$body = $_POST;

		$this->body = (array) $body;
	}

	protected function uri(): string 
	{
		return $this->uri;
	}

	protected function query( $key ): string 
	{	
		$value = $this->query[$key] ?? null;

		if(!is_null($value)) 
		{
			$value = filter_var($value, FILTER_SANITIZE_STRING);
		}

		return  $value;
	}

	protected function body( $key ): string 
	{
		$value = $this->body[$key] ?? null;

		if(!is_null($value))
		{
			$value = filter_var($value, FILTER_SANITIZE_STRING);
		}

		return $value;
	}

}