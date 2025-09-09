<?php 

namespace app\routers;

class Uri {

    private ?string $uri = null;

    public function __construct()
    {
        $this->main();
    }

    private function main(): void {

        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    }

    public function getUri(): ?string {
        return $this->uri;
    }
}