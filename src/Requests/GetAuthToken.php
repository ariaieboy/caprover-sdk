<?php

namespace Ariaieboy\Caprover\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class GetAuthToken extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    protected function defaultBody(): array
    {
        return [
            'password' => $this->password
        ];
    }

    public function __construct(readonly protected string $password)
    {
    }


    public function resolveEndpoint(): string
    {
        return '/login';
    }
}