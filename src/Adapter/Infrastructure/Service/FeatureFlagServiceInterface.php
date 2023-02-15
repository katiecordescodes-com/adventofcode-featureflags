<?php

namespace App\Adapter\Infrastructure\Service;

use App\Application\Common\Exception\NotFoundException;
use App\Domain\FeatureFlag;

interface FeatureFlagServiceInterface
{
    /**
     * @param string $id
     * @return FeatureFlag
     * @throws NotFoundException
     */
    public function getFeatureFlagById(string $id): FeatureFlag;
}