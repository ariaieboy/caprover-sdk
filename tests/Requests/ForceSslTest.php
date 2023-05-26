<?php
it('can enable ssl on custom domain',function (){
    $res = $this->caprover->forceSsl(false);
    expect($res->failed())->toBeFalse();
    $res = $this->caprover->forceSsl(true);
    expect($res->failed())->toBeFalse();
});