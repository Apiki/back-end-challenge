<?php
namespace App;
require_once(__DIR__.'/../vendor/autoload.php');
class RenderHtml 
{
    public static function Render($caminhoTemplate) : string {
        // Função que Renderiza as Views
        ob_start();
        require __DIR__.'/View/'.$caminhoTemplate;
        $html = ob_get_clean();

        return $html;
    }
}