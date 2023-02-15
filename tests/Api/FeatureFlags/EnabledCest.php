<?php

namespace App\Tests\Api\FeatureFlags;

use App\Tests\ApiTester;

/** @noinspection PhpUnused */
class EnabledCest
{

    /**
     * @param ApiTester $I
     * @return void
     *
     * @noinspection PhpUnused
     */
    public function get_enabled_should_return_true_if_flag_is_enabled(ApiTester $I): void
    {
        $enabledFlag = 'e2e_test_enabled';

        $I->sendGet("/v1/featureflags/$enabledFlag/enabled");

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseEquals(json_encode([ 'data' => true, 'error' => null ]));
    }


    /**
     * @param ApiTester $I
     * @return void
     *
     * @noinspection PhpUnused
     */
    public function get_enabled_should_return_false_if_flag_is_disabled(ApiTester $I): void
    {
        $disabledFlag = 'e2e_test_disabled';

        $I->sendGet("/v1/featureflags/$disabledFlag/enabled");

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseEquals(json_encode([ 'data' => false, 'error' => null ]));
    }


    /**
     * @param ApiTester $I
     * @return void
     *
     * @noinspection PhpUnused
     */
    public function get_enabled_should_return_404_if_flag_not_found(ApiTester $I): void
    {
        $notFoundFlag = 'e2e_test_not_found';

        $I->sendGet("/v1/featureflags/$notFoundFlag/enabled");

        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseEquals(json_encode([ 'data' => null, 'error' => [ 'message' => 'Not found', 'fields' => null ]]));
    }
}
