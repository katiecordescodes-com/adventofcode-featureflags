<?php


namespace App\Tests\Unit\Application\Interactor\IsFeatureFlagEnabled;

use App\Adapter\Infrastructure\Service\FeatureFlagServiceInterface;
use App\Application\Common\Exception\NotFoundException;
use App\Application\Interactor\IsFeatureFlagEnabled\IsFeatureFlagEnabledInteractor;
use App\Application\Interactor\IsFeatureFlagEnabled\IsFeatureFlagEnabledOutputPort;
use App\Application\Interactor\IsFeatureFlagEnabled\IsFeatureFlagEnabledRequestModel;
use App\Application\Interactor\IsFeatureFlagEnabled\IsFeatureFlagEnabledResponseModel;
use App\Domain\FeatureFlag;
use App\Domain\ViewModel;
use Codeception\Stub;
use Codeception\Stub\Expected;
use Codeception\Test\Unit;
use Exception;

class IsFeatureFlagEnabledInteractorTest extends Unit
{
    // tests

    /**
     * @return void
     *
     * @throws Exception
     */
    public function test_isFeatureFlagEnabled_returns_true_if_flag_enabled(): void
    {
        $response = null;
        $mockIsFeatureFlagEnabledOutputPort = Stub::makeEmpty(IsFeatureFlagEnabledOutputPort::class, [
            'enabledResult' => Expected::once(function (IsFeatureFlagEnabledResponseModel $givenResponse) use (&$response) {
                $response = $givenResponse;

                return Stub::makeEmpty(ViewModel::class);
            }),
            'notFound' => Expected::never(),
        ]);

        $mockFeatureFlagServiceInterface = Stub::makeEmpty(FeatureFlagServiceInterface::class, [
            'getFeatureFlagById' => function () {
                return new FeatureFlag('test_flag', true);
            },
        ]);

        $interactor = new IsFeatureFlagEnabledInteractor($mockIsFeatureFlagEnabledOutputPort, $mockFeatureFlagServiceInterface);
        $interactor->isFeatureFlagEnabled(new IsFeatureFlagEnabledRequestModel('test_flag'));

        verify($response->isEnabled())->true();
    }

    /**
     * @return void
     *
     * @throws Exception
     */
    public function test_isFeatureFlagEnabled_returns_false_if_flag_disabled(): void
    {
        $response = null;
        $mockIsFeatureFlagEnabledOutputPort = Stub::makeEmpty(IsFeatureFlagEnabledOutputPort::class, [
            'enabledResult' => Expected::once(function (IsFeatureFlagEnabledResponseModel $givenResponse) use (&$response) {
                $response = $givenResponse;

                return Stub::makeEmpty(ViewModel::class);
            }),
            'notFound' => Expected::never(),
        ]);

        $mockFeatureFlagServiceInterface = Stub::makeEmpty(FeatureFlagServiceInterface::class, [
            'getFeatureFlagById' => function () {
                return new FeatureFlag('test_flag', false);
            }
        ]);

        $interactor = new IsFeatureFlagEnabledInteractor($mockIsFeatureFlagEnabledOutputPort, $mockFeatureFlagServiceInterface);
        $interactor->isFeatureFlagEnabled(new IsFeatureFlagEnabledRequestModel('test_flag'));

        verify($response->isEnabled())->false();
    }

    /**
     * @return void
     *
     * @throws Exception
     */
    public function test_IsFeatureFlagEnabledInteractor_returns_not_found_if_flag_not_found(): void
    {
        $response = null;
        $mockIsFeatureFlagEnabledOutputPort = Stub::makeEmpty(IsFeatureFlagEnabledOutputPort::class, [
            'notFound' => Expected::once(function ($givenResponse) use (&$response) {
                $response = $givenResponse;

                return Stub::makeEmpty(ViewModel::class);
            }),
            'enabledResult' => Expected::never(),
        ]);

        $mockFeatureFlagServiceInterface = Stub::makeEmpty(FeatureFlagServiceInterface::class, [
            'getFeatureFlagById' => function () {
                throw new NotFoundException();
            }
        ]);

        $interactor = new IsFeatureFlagEnabledInteractor($mockIsFeatureFlagEnabledOutputPort, $mockFeatureFlagServiceInterface);
        $interactor->isFeatureFlagEnabled(new IsFeatureFlagEnabledRequestModel('test_flag'));

        verify($response->isEnabled())->false();
    }
}
