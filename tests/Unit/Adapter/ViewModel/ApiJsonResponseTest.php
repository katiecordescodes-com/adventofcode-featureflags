<?php


namespace App\Tests\Unit\Adapter\ViewModel;

use App\Adapter\Presentation\ViewModel\ApiJsonResponse;
use Codeception\Test\Unit;

class ApiJsonResponseTest extends Unit
{
    // tests

    /**
     * @return void
     */
    public function test_ApiJsonResponse_formats_json_for_success_response(): void
    {
        $apiJsonResponse = new ApiJsonResponse(true);

        verify($apiJsonResponse->getStatusCode())->equals(200);
        verify($apiJsonResponse->getContent())->equals(json_encode([ 'data' => true, 'error' => null ]));
        verify($apiJsonResponse->getData())->true();
        verify($apiJsonResponse->getError())->null();
        verify($apiJsonResponse->getFields())->null();
    }

    /**
     * @return void
     */
    public function test_ApiJsonResponse_formats_json_for_error_response(): void
    {
        $apiJsonResponse = new ApiJsonResponse(null, 'Not found', [ 'id' => 'Id is required' ], 404);

        verify($apiJsonResponse->getStatusCode())->equals(404);
        verify($apiJsonResponse->getContent())->equals(json_encode([ 'data' => null, 'error' => [ 'message' => 'Not found', 'fields' => [ 'id' => 'Id is required' ] ]]));
        verify($apiJsonResponse->getData())->null();
        verify($apiJsonResponse->getError())->equals('Not found');
        verify($apiJsonResponse->getFields())->equals([ 'id' => 'Id is required' ]);
    }
}
