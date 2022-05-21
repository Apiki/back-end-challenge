<?php
namespace App;

/**
 * Manages api requests
 */
class Currency {

	/* Currency uri */
	public $uri = '/exchange';

	/* Registered Symbols */
	public $symbols = [
		'USD' => [
			'symbol' => '$'
		],
		'BRL' => [
			'symbol' => 'R$'
		],
		'EUR' => [
			'symbol' => '€'
		]
	];


	/* Create a new currency object with api interface */
	public function __construct()
	{
		$this->api = new Api();
		$apiRouteRegex = '/^exchange\/(?<amount>\d+(?:\.\d+)?)\/(?<from>[A-Z]{3})\/(?<to>[A-Z]{3})\/(?<rate>\d+(?:\.\d+)?)$/';
		$this->api->routes[ $apiRouteRegex ] = [ $this, 'convertEndpoint' ];
	}

	/* Convert currencies */
	public function convert( float $amount, string $from, string $to, float $rate )
	{
		return [
			'valorConvertido' => $amount * $rate,
			'simboloMoeda' => $this->symbols[ $to ]['symbol']
		];
	}

	/* Proxy API request to convert function*/
	public function convertEndpoint( $matches ) : void
	{
		$this->api->response( $this->convert(
			amount: $matches['amount'],
			from: $matches['from'],
			to: $matches['to'],
			rate: $matches['rate']
		) );
	}

}
?>