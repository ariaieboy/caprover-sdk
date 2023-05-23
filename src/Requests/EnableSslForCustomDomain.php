<?php

namespace Ariaieboy\Caprover\Requests;

use Ariaieboy\Caprover\Common\InteractWithDomain;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class EnableSslForCustomDomain extends Request implements HasBody
{
    use HasJsonBody;
    use InteractWithDomain;

    protected Method $method = Method::POST;

    protected function defaultBody(): array
    {
        $host = $this->getHost($this->customDomain);
        return [
            'appName' => $this->appName,
            'customDomain' => $host
        ];
    }

    public function __construct(readonly public string $appName, readonly public string $customDomain)
    {
    }


    public function resolveEndpoint(): string
    {
        return '/user/apps/appDefinitions/enablecustomdomainssl';
    }
}