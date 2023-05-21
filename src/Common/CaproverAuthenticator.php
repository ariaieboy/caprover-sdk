<?php

namespace Ariaieboy\Caprover\Common;

use Saloon\Contracts\Authenticator;
use Saloon\Contracts\PendingRequest;

class CaproverAuthenticator implements Authenticator
{
    public function __construct(readonly protected string $authToken)
    {
    }

    public function set(PendingRequest $pendingRequest): void
    {
        $pendingRequest->headers()->add('x-captain-auth', $this->authToken);
    }
}