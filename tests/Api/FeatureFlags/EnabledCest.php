<?php

namespace App\Tests\Api\FeatureFlags;

use App\Tests\ApiTester;

class EnabledCest
{
    public function get_enabled_should_return_true_if_flag_is_enabled(ApiTester $I)
    {
        $enabledFlag = 'e2e_test_enabled';

        $I->sendGet("/v1/featureflags/${enabledFlag}/enabled");

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseEquals(json_encode(true));
    }

    public function get_enabled_should_return_false_if_flag_is_disabled(ApiTester  $I)
    {
        $disabledFlag = 'e2e_test_disabled';

        $I->sendGet("/v1/featureflags/${disabledFlag}/enabled");

        $I->seeResponseCodeIsSuccessful();;
        $I->seeResponseIsJson();
        $I->seeResponseEquals(json_encode(false));
    }

    public function get_enabled_should_return_404_if_flag_not_found(ApiTester $I)
    {
        $notFoundFlag = 'e2e_test_not_found';

        $I->sendGet("/v1/featureflags/${notFoundFlag}/enabled");

        $I->seeResponseCodeIs(404);
    }
}
