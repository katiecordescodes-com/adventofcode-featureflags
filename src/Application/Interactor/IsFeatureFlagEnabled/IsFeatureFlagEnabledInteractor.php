<?php

namespace App\Application\Interactor\IsFeatureFlagEnabled;

use App\Adapter\Infrastructure\Service\FeatureFlagServiceInterface;
use App\Application\Common\Exception\NotFoundException;
use App\Domain\ViewModel;

class IsFeatureFlagEnabledInteractor implements IsFeatureFlagEnabledInputPort
{
    private IsFeatureFlagEnabledOutputPort $outputPort;
    private FeatureFlagServiceInterface $featureFlagService;

    /**
     * @param IsFeatureFlagEnabledOutputPort $outputPort
     * @param FeatureFlagServiceInterface $featureFlagService
     */
    public function __construct(IsFeatureFlagEnabledOutputPort $outputPort, FeatureFlagServiceInterface $featureFlagService) {
        $this->outputPort = $outputPort;
        $this->featureFlagService = $featureFlagService;
    }

    /**
     * @inheritdoc
     */
    public function isFeatureFlagEnabled(IsFeatureFlagEnabledRequestModel $request): ViewModel
    {
        try {
            $featureFlag = $this->featureFlagService->getFeatureFlagById($request->getFlagId());

            return $this->outputPort->enabledResult(new IsFeatureFlagEnabledResponseModel($featureFlag->isEnabled()));
        } catch (NotFoundException) {
            return $this->outputPort->notFound(new IsFeatureFlagEnabledResponseModel(false));
        }
    }
}
