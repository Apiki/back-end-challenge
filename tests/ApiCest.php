<?php

class ApiCest
{
    // -----------------------------------------------------------------
    // Erro 400 — segmentos faltando
    // -----------------------------------------------------------------

    public function tryApiPrefixOnly(ApiTester $I)
    {
        $I->sendGET('/exchange');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiWithoutFrom(ApiTester $I)
    {
        $I->sendGET('/exchange/10');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiWithoutTo(ApiTester $I)
    {
        $I->sendGET('/exchange/10/EUR');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiWithoutRate(ApiTester $I)
    {
        $I->sendGET('/exchange/10/EUR/USD');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    // -----------------------------------------------------------------
    // Erro 400 — valores inválidos
    // -----------------------------------------------------------------

    public function tryApiInvalidValue(ApiTester $I)
    {
        $I->sendGET('/exchange/a/EUR/USD/0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiNegativeValue(ApiTester $I)
    {
        $I->sendGET('/exchange/-10/EUR/USD/0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiInvalidFrom(ApiTester $I)
    {
        $I->sendGET('/exchange/10/eur/USD/0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiInvalidTo(ApiTester $I)
    {
        $I->sendGET('/exchange/10/EUR/usd/0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiInvalidRate(ApiTester $I)
    {
        $I->sendGET('/exchange/10/EUR/USD/a');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiNegativeRate(ApiTester $I)
    {
        $I->sendGET('/exchange/10/EUR/USD/-0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    // -----------------------------------------------------------------
    // 200 — conversões válidas (cobrindo as 4 direções do enunciado)
    // -----------------------------------------------------------------

    public function tryApiBrlToUsd(ApiTester $I)
    {
        $I->sendGET('/exchange/7.8/BRL/USD/0.5');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 3.9,
            'simboloMoeda' => '$',
        ]);
    }

    public function tryApiUsdToBrl(ApiTester $I)
    {
        $I->sendGET('/exchange/7/USD/BRL/0.5');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 3.5,
            'simboloMoeda' => 'R$',
        ]);
    }

    public function tryApiBrlToEur(ApiTester $I)
    {
        $I->sendGET('/exchange/7/BRL/EUR/5');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 35,
            'simboloMoeda' => '€',
        ]);
    }

    public function tryApiEurToBrl(ApiTester $I)
    {
        $I->sendGET('/exchange/7/EUR/BRL/5');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 35,
            'simboloMoeda' => 'R$',
        ]);
    }

    // Exemplo exato do enunciado:
    // GET /exchange/10/BRL/USD/4.50 -> {"valorConvertido": 45, "simboloMoeda": "$"}
    public function tryApiSpecExample(ApiTester $I)
    {
        $I->sendGET('/exchange/10/BRL/USD/4.50');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 45,
            'simboloMoeda' => '$',
        ]);
    }
}
