<?php


namespace App\Tests\Unit\Adapter\Presenter;

use App\Adapter\Presentation\Presenter\IsFeatureFlagEnabledJsonPresenter;
use App\Adapter\Presentation\ViewModel\ApiJsonResponseViewModel;
use App\Application\Interactor\IsFeatureFlagEnabled\IsFeatureFlagEnabledResponseModel;
use Codeception\Test\Unit;

class IsFeatureFlagEnabledJsonPresenterTest extends Unit
{
    // tests

    /**
     * @return void
     */
    public function test_EnabledResult_returns_a_successful_result(): void
    {
        $isFeatureFlagEnabledJsonPresenter = new IsFeatureFlagEnabledJsonPresenter();

        /** @var ApiJsonResponseViewModel $response */
        $response = $isFeatureFlagEnabledJsonPresenter->enabledResult(new IsFeatureFlagEnabledResponseModel(true));

        verify($response->getResponse()->getStatusCode())->equals(200);
        verify($response->getResponse()->getData())->equals(true);
        verify($response->getResponse()->getError())->null();
        verify($response->getResponse()->getFields())->null();
    }

    /**
     * @return void
     */
    public function test_NotFound_returns_a_404_error(): void
    {
        $isFeatureFlagEnabledJsonPresenter = new IsFeatureFlagEnabledJsonPresenter();

        /** @var ApiJsonResponseViewModel $response */
        $response = $isFeatureFlagEnabledJsonPresenter->notFound(new IsFeatureFlagEnabledResponseModel(false));

        verify($response->getResponse()->getStatusCode())->equals(404);
        verify($response->getResponse()->getData())->null();
        verify($response->getResponse()->getError())->equals('Not found');
        verify($response->getResponse()->getFields())->null();
    }
}
