<?php


namespace App\Tests\Unit\Adapter\ViewModel;

use App\Adapter\Presentation\ViewModel\ApiJsonResponse;
use App\Adapter\Presentation\ViewModel\ApiJsonResponseViewModel;
use Codeception\Stub;
use Codeception\Test\Unit;
use Exception;

class ApiJsonResponseViewModelTest extends Unit
{
    // tests

    /**
     * @return void
     *
     * @throws Exception
     */
    public function test_GetResponse_returns_response(): void
    {
        $mockJsonResponse = Stub::makeEmpty(ApiJsonResponse::class);

        $jsonResponseViewModel = new ApiJsonResponseViewModel($mockJsonResponse);

        verify($jsonResponseViewModel->getResponse())->equals($mockJsonResponse);
    }
}
