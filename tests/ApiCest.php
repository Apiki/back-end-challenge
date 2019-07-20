<?php
class ApiCest
{
    public function tryApiWithoutValue(ApiTester $I)
    {
        $I->sendGET('/');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiWithoutFrom(ApiTester $I)
    {
        $I->sendGET('/10');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiWithoutTo(ApiTester $I)
    {
        $I->sendGET('/10/EUR');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiWithoutRate(ApiTester $I)
    {
        $I->sendGET('/10/EUR/USD');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiInvalidValue(ApiTester $I)
    {
        $I->sendGET('/a/EUR/USD/0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiNegativeValue(ApiTester $I)
    {
        $I->sendGET('/-10/EUR/USD/0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiInvalidFrom(ApiTester $I)
    {
        $I->sendGET('/10/eur/USD/0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiInvalidTo(ApiTester $I)
    {
        $I->sendGET('/10/EUR/usd/0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiInvalidRate(ApiTester $I)
    {
        $I->sendGET('/10/EUR/USD/a');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiNegativeRate(ApiTester $I)
    {
        $I->sendGET('/10/EUR/USD/-0.5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiEurToUsd(ApiTester $I)
    {
        $I->sendGET('/7.8/EUR/USD/0.5');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 3.9,
            'simboloMoeda' => '$',
        ]);
    }

    public function tryApiEurToBrl(ApiTester $I)
    {
        $I->sendGET('/7/EUR/BRL/0.5');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 3.5,
            'simboloMoeda' => 'R$',
        ]);
    }

    public function tryApiUsdToEur(ApiTester $I)
    {
        $I->sendGET('/7/USD/EUR/5');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 35,
            'simboloMoeda' => '€',
        ]);
    }
}