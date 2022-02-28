<?php

test('example', function () {
    $cs = new Ariaieboy\CaproverSdk\CaproverSdk(server: $_SERVER['CAPROVER_SERVER'], password: $_SERVER['CAPROVER_PASSWORD']);
    try {
        $cs->removeCustomDomain('test', 'https://test.dir.bz');
    } catch (\Ariaieboy\CaproverSdk\Exceptions\CaproverErrorException $e) {
        var_dump($e->getCode());
        die();
    }
});
