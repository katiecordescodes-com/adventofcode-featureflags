<?php

namespace App\Application\UseCase;

use App\Adapter\Infrastructure\Provider\FeatureFlagProviderInterface;

class IsFeatureFlagEnabled implements IsFeatureFlagEnabledInterface
{
    private FeatureFlagProviderInterface $featureFlagProvider;

    public function __construct(FeatureFlagProviderInterface $featureFlagProvider)
    {
        $this->featureFlagProvider = $featureFlagProvider;
    }

    /**
     * @inheritDoc
     */
    public function execute(string $flagId): bool
    {
        $featureFlag = $this->featureFlagProvider->getFeatureFlagById($flagId);

        return $featureFlag->isEnabled();
    }
}