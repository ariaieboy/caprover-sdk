<?php
it('can enable ssl on root domain',function (){
    $res = $this->caprover->enableRootSsl("ariaieboy.ir@gmail.com");
    expect($res->failed())->toBeFalse();
});