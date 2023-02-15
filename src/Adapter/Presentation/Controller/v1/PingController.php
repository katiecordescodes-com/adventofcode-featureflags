<?php

namespace App\Adapter\Presentation\Controller\v1;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/** @noinspection PhpUnused */
class PingController
{

    /**
     * @return JsonResponse
     *
     * @noinspection PhpUnused
     */
    #[Route('/v1/ping', name: 'app_v1_ping')]
    public function ping(): JsonResponse
    {
        return new JsonResponse('');
    }
}