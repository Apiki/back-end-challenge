<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.2
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

header('Content-Type: application/json');
  
if ($_SERVER["REQUEST_URI"]) {
  $url = explode('/', $_SERVER['REQUEST_URI']);
  array_shift($url);            
  
  if ($url[0] === 'exchange') {
    $service = 'App\Services\\'.ucfirst($url[0]).'Service';
    
    array_shift($url);
    
    $method = strtolower($_SERVER['REQUEST_METHOD']);           
    
    $response = call_user_func_array([new $service, $method], $url);

    http_response_code(200);
    echo json_encode($response);
    exit;      
  }
}
    