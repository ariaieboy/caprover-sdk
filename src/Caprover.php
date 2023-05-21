<?php

namespace Ariaieboy\Caprover;

use Saloon\Http\Connector;

class Caprover extends Connector
{
    public function __construct(readonly protected string $server, readonly protected string $password, protected int $timeout = 60)
    {
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
