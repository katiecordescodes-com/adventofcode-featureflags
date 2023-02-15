<?php

namespace App\Tests\Api;

use App\Tests\ApiTester;

/** @noinspection PhpUnused */
class PingCest
{

    /**
     * @param ApiTester $I
     * @return void
     *
     * @noinspection PhpUnused
     */
    public function get_ping_should_return_successful(ApiTester $I): void
    {
        $I->sendGet('/v1/ping');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseEquals('""');
    }
}
