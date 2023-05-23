<?php

namespace Ariaieboy\Caprover\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class AttachNewCustomDomainToApp extends Request
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    protected function defaultBody(): array
    {
        return [
            'appName' => $this->appName,
            'customDomain' => $this->customDomain
        ];
    }

    public function __construct(readonly public string $appName, readonly public string $customDomain)
    {
    }


    public function resolveEndpoint(): string
    {
        return '/user/apps/appDefinitions/customdomain';
    }
}