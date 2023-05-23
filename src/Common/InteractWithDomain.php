<?php

namespace Ariaieboy\Caprover\Common;

trait InteractWithDomain
{
    public function getHost(string $domain): string
    {
        return parse_url($domain)['host'];
    }
}