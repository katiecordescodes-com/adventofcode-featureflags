<?php


namespace App\Tests\Unit\Adapter\Infrastructure\Provider;

use App\Adapter\Infrastructure\Provider\SplitIoFeatureFlagProvider;
use App\Application\Common\Exception\NotFoundException;
use App\Tests\UnitTester;
use Codeception\Stub;
use Codeception\Test\Unit;
use Codeception\Verify\Verify;
use Exception;
use SplitIO\Sdk\ClientInterface;
use SplitIO\Sdk\Factory\SplitFactoryInterface;
use Throwable;

class SplitIoFeatureFlagProviderTest extends Unit
{

    protected UnitTester $tester;

    /**
     * @return void
     * @throws Exception
     */
    public function test_getFeatureFlagById_returns_an_enabled_flag(): void
    {
        $mockSplitIoClient = Stub::makeEmpty(ClientInterface::class, [
            'getTreatment' => function () {
                return 'on';
            },
        ]);

        $mockSplitIoFactory = Stub::makeEmpty(SplitFactoryInterface::class, [
            'client' => $mockSplitIoClient,
        ]);

        $splitIoFeatureFlagProvider = new SplitIoFeatureFlagProvider($mockSplitIoFactory);

        $resultFlag = $splitIoFeatureFlagProvider->getFeatureFlagById('test_flag');

        expect($resultFlag->getId())->toEqual('test_flag');
        expect($resultFlag->isEnabled())->toBeTrue();

        $mockSplitIoClient->expects($this->exactly(1))->method('getTreatment')->with('feature_flags_microservice', 'test_flag');
    }

    /**
     * @return void
     * @throws Exception
     */
    public function test_getFeatureFlagById_returns_a_disabled_flag(): void
    {
        $mockSplitIoClient = Stub::makeEmpty(ClientInterface::class, [
            'getTreatment' => function () {
                return 'off';
            },
        ]);

        $mockSplitIoFactory = Stub::makeEmpty(SplitFactoryInterface::class, [
            'client' => $mockSplitIoClient,
        ]);

        $splitIoFeatureFlagProvider = new SplitIoFeatureFlagProvider($mockSplitIoFactory);

        $resultFlag = $splitIoFeatureFlagProvider->getFeatureFlagById('test_flag');

        expect($resultFlag->getId())->toEqual('test_flag');
        expect($resultFlag->isEnabled())->toBeFalse();

        $mockSplitIoClient->expects($this->exactly(1))->method('getTreatment')->with('feature_flags_microservice', 'test_flag');
    }

    /**
     * @return void
     * @throws Exception
     * @throws Throwable
     */
    public function test_getFeatureFlagById_throws_not_found(): void
    {
        $mockSplitIoClient = Stub::makeEmpty(ClientInterface::class, [
            'getTreatment' => function () {
                return 'control';
            },
        ]);

        $mockSplitIoFactory = Stub::makeEmpty(SplitFactoryInterface::class, [
            'client' => $mockSplitIoClient,
        ]);

        $splitIoFeatureFlagProvider = new SplitIoFeatureFlagProvider($mockSplitIoFactory);

        Verify::Callable(function () use ($splitIoFeatureFlagProvider) {
            $splitIoFeatureFlagProvider->getFeatureFlagById('test_flag');
        })->throws(NotFoundException::class);

        $mockSplitIoClient->expects($this->exactly(1))->method('getTreatment')->with('feature_flags_microservice', 'test_flag');
    }
}
