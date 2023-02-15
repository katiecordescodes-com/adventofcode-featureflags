<?php

namespace App\Adapter\Presentation\Controller\v1\FeatureFlags;

use App\Application\Interactor\IsFeatureFlagEnabled\IsFeatureFlagEnabledInputPort;
use App\Application\Interactor\IsFeatureFlagEnabled\IsFeatureFlagEnabledRequestModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/** @noinspection PhpUnused */
class EnabledController extends AbstractController
{
    private IsFeatureFlagEnabledInputPort $interactor;


    /**
     * @param IsFeatureFlagEnabledInputPort $interactor
     *
     * @noinspection PhpUnused
     */
    public function __construct(IsFeatureFlagEnabledInputPort $interactor)
    {
        $this->interactor = $interactor;
    }


    /**
     * @param string $flagId
     * @return JsonResponse
     *
     * @noinspection PhpUnused
     */
    #[Route('/v1/featureflags/{flagId}/enabled', name: 'app_v1_featureflags_enabled')]
    public function enabled(string $flagId): JsonResponse
    {
        $viewModel = $this->interactor->isFeatureFlagEnabled(new IsFeatureFlagEnabledRequestModel($flagId));

        return $viewModel->getResponse();
    }
}