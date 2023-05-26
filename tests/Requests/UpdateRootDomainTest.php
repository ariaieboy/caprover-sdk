<?php
it('can attach a custom domain to the application',function (){
    $domain = str_replace('captain','fake',$this->caprover_domain);
    $res = $this->caprover->updateRootDomain($domain);
    expect($res->failed())->toBeFalse();
});