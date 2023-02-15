<?php

namespace App\Adapter\Presentation\ViewModel;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiJsonResponse extends JsonResponse
{
    private mixed $apiData;
    private ?string $error;
    private ?array $fields;

    /**
     * @param mixed|null $data
     * @param string|null $error
     * @param array|null $fields
     * @param int $status
     */
    public function __construct(mixed $data = null, string $error = null, array $fields = null, int $status = 200)
    {
        parent::__construct([ 'data' => $data, 'error' => $error ? [ 'message' => $error, 'fields' => $fields] : null ], $status);
        $this->apiData = $data;
        $this->error = $error;
        $this->fields = $fields;
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->apiData;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @return array|null
     */
    public function getFields(): ?array
    {
        return $this->fields;
    }
}