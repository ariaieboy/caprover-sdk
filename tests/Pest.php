<?php
use Ariaieboy\Caprover\Tests\TestCase;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\PendingRequest;

uses(TestCase::class)->beforeEach(function (){
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $this->mockClient = new MockClient([
        '*' => function (PendingRequest $request) {
            $reflection = new ReflectionClass($request->getRequest());
            $fake = \Illuminate\Support\Arr::first(array_filter($request->body()->all(),function ($var){
                return preg_match("/fake\.*/",$var);
            }))??'';
            return MockResponse::fixture($reflection->getShortName().$fake);
        },
    ]);
    $this->caprover = new \Ariaieboy\Caprover\Caprover($_ENV['CAPROVER_SERVER'],$_ENV['CAPROVER_PASSWORD']);
    $this->caprover->withMockClient($this->mockClient);
    $this->test_app = $_ENV['CAPROVER_TEST_APP'];
    $this->test_domain = $_ENV['CAPROVER_TEST_DOMAIN'];
})->in(__DIR__);
