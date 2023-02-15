<?php


namespace App\Tests\Unit\Application\Interactor\IsFeatureFlagEnabled;

use App\Application\Interactor\IsFeatureFlagEnabled\IsFeatureFlagEnabledResponseModel;
use Codeception\Test\Unit;

class IsFeatureFlagEnabledResponseModelTest extends Unit
{
    // tests

    /**
     * @return void
     */
    public function test_IsEnabled_returns_the_initial_is_enabled_value(): void
    {
        $response = new IsFeatureFlagEnabledResponseModel(true);

        verify($response->isEnabled())->true();
    }
}
