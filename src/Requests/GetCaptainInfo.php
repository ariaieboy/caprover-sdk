<?php

namespace Ariaieboy\Caprover\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class GetCaptainInfo extends Request
{

    protected Method $method = Method::GET;

    public function __construct()
    {
    }


    public function resolveEndpoint(): string
    {
        return '/user/system/info';
    }
}