<?php

namespace App\Tests\Api;

use App\Tests\ApiTester;

class PingCest
{
    public function getPingShouldReturnSuccessful(ApiTester $I): void
    {
        $I->sendGet('/v1/ping');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseEquals('""');
    }
}
