<?php

namespace App\Tests\Api;

use App\Tests\ApiTester;

class PingCest
{
    public function getPingReturnsSuccess(ApiTester $I): void
    {
        $I->sendGet('/ping');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseEquals('');
    }
}
