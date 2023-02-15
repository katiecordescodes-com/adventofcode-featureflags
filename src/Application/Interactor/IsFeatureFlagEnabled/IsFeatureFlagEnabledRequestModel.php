<?php

namespace App\Application\Interactor\IsFeatureFlagEnabled;

class IsFeatureFlagEnabledRequestModel
{
    private string $flagId;

    /**
     * @param string $flagId
     */
    public function __construct(string $flagId) {
        $this->flagId = $flagId;
    }

    /**
     * @return string
     */
    public function getFlagId(): string
    {
        return $this->flagId;
    }
}