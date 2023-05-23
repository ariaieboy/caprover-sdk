<?php
beforeEach(function (){
    $this->caprover->attachNewCustomDomainToApp($this->test_app,$this->test_domain);
});
it('can remove custom domain',function (){
    $res = $this->caprover->removeCustomDomain($this->test_app,$this->test_domain);
    expect($res->failed())->toBeFalse();
});