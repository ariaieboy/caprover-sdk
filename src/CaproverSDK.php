<?php

namespace Ariaieboy\CaproverSDK;

class CaproverSDK
{
    public function __construct(string $server = null, string $password = null, int $timeout = null)
    {
        $server ??= config('caprover-laravel.server') ?? '';
        $password ??= config('caprover-laravel.password') ?? '';
        $timeout ??= config('caprover-laravel.timeout') ?? 60;
    }
}
