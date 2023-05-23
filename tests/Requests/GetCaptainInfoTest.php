<?php
it('can getCaptainInfo',function (){
   $res = $this->caprover->getCaptainInfo();
   expect($res->failed())->toBeFalse();
});