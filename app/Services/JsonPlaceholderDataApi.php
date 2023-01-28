<?php

namespace App\Services;

use App\Models\User\User;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class JsonPlaceholderDataApi implements DataApiInterface
{
    /**
     * Base uri of this third party
     * @var string
     */
    protected string $baseUri;

    /**
     *
     */
    public function __construct()
    {
        $this->baseUri = config('jsonplaceholder.base_uri');
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        $apiResponse = $this->sendRequest('GET', 'users');

        return !is_null($apiResponse)
                    ? $apiResponse->json()
                    : [];
    }

    public function getPosts(): array
    {
        // TODO: Implement getPosts() method.
    }

    /**
     * @param int $userId
     * @return array
     */
    public function getPostsByUser(int $userId): array
    {
        $apiResponse = $this->sendRequest(
            method: 'GET',
            resource: 'posts',
            queryString: [
                'userId' => $userId
            ]
        );

        return !is_null($apiResponse)
            ? $apiResponse->json()
            : [];
    }

    /**
     * @param string $method
     * @param string $resource
     * @param array $queryString
     * @param array $body
     * @return Response|null
     */
    protected function sendRequest(string $method, string $resource, array $queryString = [], array $body = []): ?Response
    {
        $endpoint = $this->baseUri .'/'. $resource;

        try {

            //TODO add retry logic in case that API required it
            $apiResponse = Http::{$method}(
                $endpoint,
                $method == 'GET' ? $queryString : $body
            );

            return $apiResponse;
        } catch (RequestException $requestException) {
            \Log::error($requestException);

            return null;
        }
    }
}
