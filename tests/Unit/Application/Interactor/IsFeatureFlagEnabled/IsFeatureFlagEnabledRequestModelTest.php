<?php


namespace App\Tests\Unit\Application\Interactor\IsFeatureFlagEnabled;

use App\Application\Interactor\IsFeatureFlagEnabled\IsFeatureFlagEnabledRequestModel;
use Codeception\Test\Unit;

class IsFeatureFlagEnabledRequestModelTest extends Unit
{
    // tests

    /**
     * @return void
     */
    public function test_GetFlagId_should_return_the_initial_flag_id(): void
    {
        $request = new IsFeatureFlagEnabledRequestModel('test_flag');

        verify($request->getFlagId())->equals('test_flag');
    }
}
