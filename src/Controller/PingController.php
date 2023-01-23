<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PingController
{
    #[Route('/ping', name: 'app_ping')]
    public function ping(): Response
    {
        return new Response();
    }
}