<?php

namespace App\Adapter\Infrastructure\Provider;

use App\Application\Common\Exception\NotFoundException;
use App\Domain\FeatureFlag;
use SplitIO\Sdk\ClientInterface;
use SplitIO\Sdk\Factory\SplitFactoryInterface;

class SplitIoFeatureFlagProvider implements FeatureFlagProviderInterface
{
    private ClientInterface $splitIoClient;

    public function __construct(SplitFactoryInterface $splitIoFactory)
    {
        $this->splitIoClient = $splitIoFactory->client();
    }

    /**
     * @param string $id
     * @return FeatureFlag
     * @throws NotFoundException
     */
    public function getFeatureFlagById(string $id): FeatureFlag
    {
        $treatment = $this->splitIoClient->getTreatment('feature_flags_microservice', $id);

        return match ($treatment) {
            'on' => new FeatureFlag($id, true),
            'off' => new FeatureFlag($id, false),
            default => throw new NotFoundException("Feature flag ${id} not found"),
        };
    }
}