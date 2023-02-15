<?php

namespace App\Adapter\Presentation\Presenter;

use App\Adapter\Presentation\ViewModel\ApiJsonResponse;
use App\Adapter\Presentation\ViewModel\ApiJsonResponseViewModel;
use App\Application\Interactor\IsFeatureFlagEnabled\IsFeatureFlagEnabledOutputPort;
use App\Application\Interactor\IsFeatureFlagEnabled\IsFeatureFlagEnabledResponseModel;
use App\Domain\ViewModel;

class IsFeatureFlagEnabledJsonPresenter implements IsFeatureFlagEnabledOutputPort
{

    /**
     * @param IsFeatureFlagEnabledResponseModel $response
     * @return ViewModel
     */
    public function enabledResult(IsFeatureFlagEnabledResponseModel $response): ViewModel
    {
        return new ApiJsonResponseViewModel(new ApiJsonResponse($response->isEnabled()));
    }

    /**
     * @param IsFeatureFlagEnabledResponseModel $response
     * @return ViewModel
     */
    public function notFound(IsFeatureFlagEnabledResponseModel $response): ViewModel
    {
        return new ApiJsonResponseViewModel(new ApiJsonResponse(null, 'Not found', null, 404));
    }
}