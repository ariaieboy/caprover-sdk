<?php
it('can attach a custom domain to the application',function (){
    $res = $this->caprover->attachNewCustomDomainToApp($this->test_app,$this->test_domain);
    expect($res->failed())->toBeFalse();
});