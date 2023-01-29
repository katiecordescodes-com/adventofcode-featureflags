<?php


namespace App\Tests\Unit\Application\UseCase;

use App\Adapter\Infrastructure\Provider\FeatureFlagProviderInterface;
use App\Application\Common\Exception\NotFoundException;
use App\Application\UseCase\IsFeatureFlagEnabled;
use App\Domain\FeatureFlag;
use App\Tests\UnitTester;
use Codeception\Stub;
use Codeception\Test\Unit;
use Codeception\Verify\Verify;
use Exception;
use Throwable;

class IsFeatureFlagEnabledTest extends Unit
{

    protected UnitTester $tester;

    // tests

    /**
     * @throws NotFoundException
     * @throws Exception
     */
    public function test_IsFeatureFlagEnabled_should_return_true_if_flag_is_enabled(): void
    {
        $mockFeatureFlagProvider = Stub::makeEmpty(FeatureFlagProviderInterface::class, [
            'getFeatureFlagById' => function () {
                return new FeatureFlag('enabled_test', true);
            },
        ]);

        $isFeatureFlagEnabled = new IsFeatureFlagEnabled($mockFeatureFlagProvider);

        $result = $isFeatureFlagEnabled->execute('enabled_test');
        expect($result)->toBeTrue();

        $mockFeatureFlagProvider->expects($this->exactly(1))->method('getFeatureFlagById')->with('enabled_test');
    }

    /**
     * @return void
     * @throws NotFoundException
     * @throws Exception
     */
    public function test_IsFeatureFlagEnabled_should_return_false_if_flag_is_disabled(): void
    {
        $mockFeatureFlagProvider = Stub::makeEmpty(FeatureFlagProviderInterface::class, [
            'getFeatureFlagById' => function() {
                return new FeatureFlag('disabled_test', false);
            }
        ]);

        $isFeatureFlagEnabled = new IsFeatureFlagEnabled($mockFeatureFlagProvider);

        $result = $isFeatureFlagEnabled->execute('disabled_test');
        expect($result)->toBeFalse();

        $mockFeatureFlagProvider->expects($this->exactly(1))->method('getFeatureFlagById')->with('disabled_test');
    }

    /**
     * @return void
     * @throws Exception
     * @throws Throwable
     */
    public function test_IsFeatureFlagEnabled_should_throw_NotFoundException_if_flag_not_found(): void
    {
        $mockFeatureFlagProvider = Stub::makeEmpty(FeatureFlagProviderInterface::class, [
            'getFeatureFlagById' => function() {
                throw new NotFoundException();
            }
        ]);

        $isFeatureFlagEnabled = new IsFeatureFlagEnabled($mockFeatureFlagProvider);

        Verify::Callable(function () use ($isFeatureFlagEnabled) {
            $isFeatureFlagEnabled->execute('not_found_flag');
        })->throws(NotFoundException::class);
    }
}
