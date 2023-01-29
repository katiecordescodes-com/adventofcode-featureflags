<?php

namespace App\Adapter\Presentation\Controller\v1;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PingController
{
    #[Route('/v1/ping', name: 'app_v1_ping')]
    public function ping(): Response
    {
        return new Response();
    }
}