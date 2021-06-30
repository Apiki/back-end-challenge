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
 * @author   pedro santos <Pedrohenriqueromio@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';


use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Controller\ConversionController;
use App\Model\Conversion;
use App\Lib\Response;

Conversion::load();

Router::get('/exchange/([0-9\.]*)/([A-Z]*)/([A-Z]*)/([0-9\.]*)', function (Request $req, Response $res) {

    $amount = ($req->params[0]);
    $rate = ($req->params[3]);
    $from = Conversion::findById($req->params[1]);
    $to = Conversion::findById($req->params[2]);

    $valorConvertido = ( $rate * $amount )  ;
    
    if ( !empty($from) && !empty($to)) {
        
        $res->status(200)->toJSON([
            'valorConvertido' => $valorConvertido,
            'simboloMoeda' => $to->simboloMoeda ,
        ]);

    } else {

        (new ConversionController())->notFound() ; 

    }
});


App::run();