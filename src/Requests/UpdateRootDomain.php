<?php

namespace Ariaieboy\Caprover\Requests;

use Ariaieboy\Caprover\Common\InteractWithDomain;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateRootDomain extends Request implements HasBody
{
    use HasJsonBody;
    use InteractWithDomain;

    protected Method $method = Method::POST;

    protected function defaultBody(): array
    {
        $host = $this->getHost($this->rootDomain);
        return [
            'rootDomain' => $host
        ];
    }

    public function __construct(readonly public string $rootDomain)
    {
    }


    public function resolveEndpoint(): string
    {
        return '/user/system/changerootdomain';
    }
}