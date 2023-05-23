<?php

namespace Ariaieboy\Caprover;

use Ariaieboy\Caprover\Requests\GetAuthToken;
use Ariaieboy\Caprover\Responses\CaproverResponse;
use JsonException;
use ReflectionException;
use Saloon\Contracts\MockClient;
use Saloon\Contracts\Request;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Http\Connector;

/**
 * @method send(Request $request, MockClient $mockClient = null)
 * @returns CaproverResponse
 */
class Caprover extends Connector
{
    private string $authToken;
    protected ?string $response = CaproverResponse::class;

    /**
     * @throws JsonException
     * @throws InvalidResponseClassException
     * @throws ReflectionException
     * @throws PendingRequestException
     */
    public function __construct(readonly protected string $server, readonly protected string $password, protected int $timeout = 60)
    {
        $this->authToken = $this->getAuthToken()->json('token');
    }

    public function hasRequestFailed(\Saloon\Contracts\Response $response): ?bool
    {
        return ($response->json('status') !== 100 || $response->json('status') !== 101);
    }

    /**
     * @throws InvalidResponseClassException
     * @throws ReflectionException
     * @throws PendingRequestException
     */
    public function getAuthToken(): CaproverResponse
    {
        return $this->send(new GetAuthToken($this->password));
    }

    public function resolveBaseUrl(): string
    {
        return rtrim($this->server, '/') . '/api/v2';
    }

    protected function defaultHeaders(): array
    {
        return [
            'x-namespace' => 'captain'
        ];
    }

    protected function defaultConfig(): array
    {
        return [
            'timeout' => $this->timeout
        ];
    }
}
