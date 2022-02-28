<?php

use Ariaieboy\CaproverSdk\Exceptions\InvalidCaproverServerInfoException;

it('will throw exception on wrong server or password', function () {
    new \Ariaieboy\CaproverSdk\CaproverSdk('fake server url','fake password');
})->throws(InvalidCaproverServerInfoException::class);
it('can get authentication token from caprover', function () {
    $cs = new \Ariaieboy\CaproverSdk\CaproverSdk(
        server: $_SERVER['CAPROVER_SERVER']??'',
        password: $_SERVER['CAPROVER_PASSWORD']??''
    );
    expect($cs)->toBeInstanceOf(\Ariaieboy\CaproverSdk\CaproverSdk::class);
});
