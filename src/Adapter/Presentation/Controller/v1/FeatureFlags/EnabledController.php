<?php

namespace App\Adapter\Presentation\Controller\v1\FeatureFlags;

use App\Application\Common\Exception\NotFoundException;
use App\Application\UseCase\IsFeatureFlagEnabledInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class EnabledController extends AbstractController
{
    #[Route('/v1/featureflags/{flagId}/enabled', name: 'app_v1_featureflags_enabled')]
    public function enabled(string $flagId, IsFeatureFlagEnabledInterface $isFeatureFlagEnabled): JsonResponse {
        try {
            $enabled = $isFeatureFlagEnabled->execute($flagId);

            return new JsonResponse($enabled);
        } catch (NotFoundException) {
            return new JsonResponse('', 404);
        }
    }
}