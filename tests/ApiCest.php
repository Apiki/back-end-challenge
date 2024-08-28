<?php

class ApiCest
{
    // Testa a API sem fornecer o valor
    public function tryApiWithoutValue(ApiTester $I)
    {
        $I->sendGET('/');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    // Testa a API sem fornecer a moeda de origem
    public function tryApiWithoutFrom(ApiTester $I)
    {
        $I->sendGET('/10');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    // Testa a API sem fornecer a moeda de destino
    public function tryApiWithoutTo(ApiTester $I)
    {
        $I->sendGET('/10/EUR');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    // Testa a API sem fornecer a taxa de conversão
    public function tryApiWithoutRate(ApiTester $I)
    {
        $I->sendGET('/10/EUR/USD');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    // Testa a API com valor inválido
    public function tryApiInvalidValue(ApiTester $I)
    {
        $I->sendGET('/a/EUR/USD/0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    // Testa a API com valor negativo
    public function tryApiNegativeValue(ApiTester $I)
    {
        $I->sendGET('/-10/EUR/USD/0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    // Testa a API com moeda de origem inválida
    public function tryApiInvalidFrom(ApiTester $I)
    {
        $I->sendGET('/10/eur/USD/0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    // Testa a API com moeda de destino inválida
    public function tryApiInvalidTo(ApiTester $I)
    {
        $I->sendGET('/10/EUR/usd/0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    // Testa a API com taxa de conversão inválida
    public function tryApiInvalidRate(ApiTester $I)
    {
        $I->sendGET('/10/EUR/USD/a');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    // Testa a API com taxa de conversão negativa
    public function tryApiNegativeRate(ApiTester $I)
    {
        $I->sendGET('/10/EUR/USD/-0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    // Testa a conversão de BRL para USD
    public function tryApiBrlToUsd(ApiTester $I)
    {
        $I->sendGET('/7.8/BRL/USD/0.5');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 3.9,
            'simboloMoeda' => '$',
        ]);
    }

    // Testa a conversão de USD para BRL
    public function tryApiUsdToBrl(ApiTester $I)
    {
        $I->sendGET('/7/USD/BRL/0.5');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 3.5,
            'simboloMoeda' => 'R$',
        ]);
    }

    // Testa a conversão de BRL para EUR
    public function tryApiBrlToEur(ApiTester $I)
    {
        $I->sendGET('/7/BRL/EUR/5');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 35,
            'simboloMoeda' => '€',
        ]);
    }

    // Testa a conversão de EUR para BRL
    public function tryApiEurToBrl(ApiTester $I)
    {
        $I->sendGET('/7/EUR/BRL/5');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 35,
            'simboloMoeda' => 'R$',
        ]);
    }
}
