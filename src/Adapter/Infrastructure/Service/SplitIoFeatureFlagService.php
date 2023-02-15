<?php

namespace App\Adapter\Infrastructure\Service;

use App\Application\Common\Exception\NotFoundException;
use App\Domain\FeatureFlag;
use SplitIO\Sdk\ClientInterface;
use SplitIO\Sdk\Factory\SplitFactoryInterface;

class SplitIoFeatureFlagService implements FeatureFlagServiceInterface
{
    private ClientInterface $splitIoClient;

    /**
     * @param SplitFactoryInterface $splitIoFactory
     */
    public function __construct(SplitFactoryInterface $splitIoFactory)
    {
        $this->splitIoClient = $splitIoFactory->client();
    }

    /**
     * @inheritdoc
     */
    public function getFeatureFlagById(string $id): FeatureFlag
    {
        $treatment = $this->splitIoClient->getTreatment('feature_flags_microservice', $id);

        return match ($treatment) {
            'on' => new FeatureFlag($id, true),
            'off' => new FeatureFlag($id, false),
            default => throw new NotFoundException("Feature flag $id not found"),
        };
    }
}