<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ExchangeController extends AbstractController
{
	##[Route('/exchage')]
	#[Route('/exchange/{amount}/{from}/{to}/{rate}', name: 'exchange_c', requirements: ['amount' => '\d+', 'rate' => '\d+'])]
	public function index($amount, $from, $to, $rate): Response
	{
		$simboloMoeda = "";
		$valorConvertido  = 0;
		$moedas = ["BRL", "USD", "EUR"];		
		#alternativa melhor do que invalidar as letras mínusculas $to = strtoupper($to);

		if(is_null($amount) || is_null($from) || is_null($to) || is_null($rate) ) {
            return new JsonResponse('Necessario passar 4 parametros', 400);
        }

		if (!in_array($from, $moedas) || !in_array($to, $moedas)) {
            return new JsonResponse('Moeda nao encontrada', 400);
        }

		//$errors = $this->validator->validate($payload);
        if (!is_numeric($rate) || !is_numeric($amount)) {
            return new JsonResponse('Parametro amount e rate precisa ser um numero', 400);
        }
        if($rate<0 || $amount<0) {
        	return new JsonResponse('Parametro amount e rate precisa ser maior que zero', 400);	
        }

		switch ($to) {
			case 'EUR':
				$simboloMoeda = '€';
				break;
			
			case 'USD':
				$simboloMoeda = '$';
				break;
			
			default:
				$simboloMoeda = 'R$';
				break;
		}

		if($rate<0)
			return new JsonResponse("", 400);

		$valorConvertido = $amount*$rate;

		return new JsonResponse(['valorConvertido' => $valorConvertido, 'simboloMoeda' => $simboloMoeda], 200);
	}
}