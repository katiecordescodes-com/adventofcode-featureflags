<?php

namespace App\Application\UseCase;

use App\Application\Common\Exception\NotFoundException;

interface IsFeatureFlagEnabledInterface
{
    /**
     * @param string $flagId
     * @return bool
     * @throws NotFoundException
     */
    public function execute(string $flagId): bool;
}