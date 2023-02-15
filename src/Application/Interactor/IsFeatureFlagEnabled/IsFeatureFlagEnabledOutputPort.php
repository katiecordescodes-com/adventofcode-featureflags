<?php

namespace App\Application\Interactor\IsFeatureFlagEnabled;

use App\Domain\ViewModel;

interface IsFeatureFlagEnabledOutputPort
{
    /**
     * @param IsFeatureFlagEnabledResponseModel $response
     * @return ViewModel
     */
    public function enabledResult(IsFeatureFlagEnabledResponseModel $response): ViewModel;

    /**
     * @param IsFeatureFlagEnabledResponseModel $response
     * @return ViewModel
     */
    public function notFound(IsFeatureFlagEnabledResponseModel $response): ViewModel;
}