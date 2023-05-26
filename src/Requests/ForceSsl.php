<?php

namespace Ariaieboy\Caprover\Requests;

use Ariaieboy\Caprover\Common\InteractWithDomain;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ForceSsl extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    protected function defaultBody(): array
    {
        return [
            'isEnabled' => $this->isEnabled
        ];
    }

    public function __construct(readonly public bool $isEnabled)
    {
    }


    public function resolveEndpoint(): string
    {
        return '/user/system/forcessl';
    }
}