<?php

namespace App\Adapter\Presentation\ViewModel;

use App\Domain\ViewModel;

class ApiJsonResponseViewModel implements ViewModel
{
    private ApiJsonResponse $response;

    /**
     * @param ApiJsonResponse $response
     */
    public function __construct(ApiJsonResponse $response)
    {
        $this->response = $response;
    }

    /**
     * @return ApiJsonResponse
     */
    public function getResponse(): ApiJsonResponse
    {
        return $this->response;
    }
}