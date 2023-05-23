<?php
it('can get auth token',function (){
   $token = $this->caprover->getAuthToken();
   expect($token->failed())->toBeFalse()
       ->and($token->json('data.token'))->not->toBeEmpty();
});