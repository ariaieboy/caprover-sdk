<?php
beforeEach(function (){
   $this->caprover->attachNewCustomDomainToApp($this->test_app,$this->test_domain);
});
afterEach(function (){
    $this->caprover->removeCustomDomain($this->test_app,$this->test_domain);
});
it('can enable ssl on custom domain',function (){
    $res = $this->caprover->enableSslForCustomDomain($this->test_app,$this->test_domain);
    expect($res->failed())->toBeFalse();
});