<?php

namespace Ariaieboy\Caprover;

use Ariaieboy\Caprover\Requests\GetAuthToken;
use JsonException;
use ReflectionException;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Http\Connector;
use Saloon\Http\Response;

class Caprover extends Connector
{
    private string $authToken;

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

    /**
     * @throws InvalidResponseClassException
     * @throws ReflectionException
     * @throws PendingRequestException
     */
    public function getAuthToken(): Response
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
