<?php 

namespace app\routers;

class Css {
    private string $css = '';

    public function __construct(array $css)
    {
        $this->main($css);
    }

    private function main(array $css):void {
        
        $this->css = $this->extractCss($css);

    }

    private function extractCss(array $css): string {
        $tags = '';

        foreach($css as $cssFile){
            if(!$cssFile)continue;

            $tags.= <<<TAGCSS
                <link rel="stylesheet" href="./src/css/{$cssFile}.css">
            TAGCSS;
        }

        return $tags;
    }

    public function getCss(): string {
        return $this->css;
    }
}