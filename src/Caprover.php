<?php

namespace Ariaieboy\Caprover;

use Saloon\Http\Connector;

class Caprover extends Connector
{
    public function __construct(readonly protected string $server, readonly protected string $password, protected int $timeout)
    {
    }
    public function resolveBaseUrl(): string
    {
        return rtrim($this->server, '/') . '/api/v2';
    }
}
