<?php

namespace App\Adapter\Infrastructure\Provider;

use App\Domain\FeatureFlag;

interface FeatureFlagProviderInterface
{
    public function getFeatureFlagById(string $id): FeatureFlag;
}