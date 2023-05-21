<?php

namespace Ariaieboy\Caprover;

use Ariaieboy\Caprover\Requests\GetAuthToken;
use Saloon\Http\Connector;

class Caprover extends Connector
{
    private string $authToken;

    public function __construct(readonly protected string $server, readonly protected string $password, protected int $timeout = 60)
    {
        $this->authToken = $this->getAuthToken();
    }

    public function getAuthToken(): string
    {
        return $this->send(new GetAuthToken($this->password))->json('token');
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
