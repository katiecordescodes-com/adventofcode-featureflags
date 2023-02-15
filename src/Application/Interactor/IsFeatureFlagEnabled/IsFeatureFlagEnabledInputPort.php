<?php

namespace App\Application\Interactor\IsFeatureFlagEnabled;

use App\Domain\ViewModel;

interface IsFeatureFlagEnabledInputPort
{
    /**
     * @param IsFeatureFlagEnabledRequestModel $request
     * @return ViewModel
     */
    public function isFeatureFlagEnabled(IsFeatureFlagEnabledRequestModel $request): ViewModel;
}