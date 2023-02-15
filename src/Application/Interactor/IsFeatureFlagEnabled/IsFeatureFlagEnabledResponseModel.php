<?php

namespace App\Application\Interactor\IsFeatureFlagEnabled;

class IsFeatureFlagEnabledResponseModel
{
    private bool $isEnabled;

    /**
     * @param bool $isEnabled
     */
    public function __construct(bool $isEnabled) {
        $this->isEnabled = $isEnabled;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool {
        return $this->isEnabled;
    }
}