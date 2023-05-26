<?php

namespace Ariaieboy\Caprover\Requests;

use Ariaieboy\Caprover\Common\InteractWithDomain;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class EnableRootSsl extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    protected function defaultBody(): array
    {
        return [
            'emailAddress' => $this->emailAddress
        ];
    }

    public function __construct(readonly public string $emailAddress)
    {
    }


    public function resolveEndpoint(): string
    {
        return '/user/system/enablessl';
    }
}