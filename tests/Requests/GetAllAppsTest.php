<?php
it('can getAllApps',function (){
   $res = $this->caprover->getAllApps();
   expect($res->failed())->toBeFalse();
});