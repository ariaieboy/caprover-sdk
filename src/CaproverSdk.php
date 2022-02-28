<?php

namespace Ariaieboy\CaproverSdk;


use Ariaieboy\CaproverSdk\Exceptions\CannotGetTokenException;
use Ariaieboy\CaproverSdk\Exceptions\InvalidCaproverServerInfoException;
use Exception;
use GuzzleHttp\Client;

class CaproverSdk
{
    //Api Possible Errors
    const OKAY = 100;
    const OKAY_BUILD_START = 101;
    const STATUS_ERROR_GENERIC = 1000;
    const STATUS_ERROR_CAPTAIN_NOT_INITIALIZED = 1001;
    const STATUS_ERROR_USER_NOT_INITIALIZED = 1101;
    const STATUS_ERROR_NOT_AUTHORIZED = 1102;
    const STATUS_ERROR_ALREADY_EXIST = 1103;
    const STATUS_ERROR_BAD_NAME = 1104;
    const STATUS_WRONG_PASSWORD = 1105;
    const STATUS_AUTH_TOKEN_INVALID = 1106;
    const VERIFICATION_FAILED = 1107;

    const UNKNOWN_ERROR = 1999;


    protected ?string $token = null;
    protected Client $client;

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws InvalidCaproverServerInfoException
     */
    public function __construct(protected string $server, protected string $password)
    {
        $this->server = rtrim($this->server, '/') . '/api/v2';
        $this->getAuthToken();
        $this->client = new Client(['base_url' => $this->server, 'verify' => true, 'headers' => [
            'x-namespace' => 'captain', 'x-captain-auth' => $this->token
        ]]);
    }

    /**
     * @return void
     * @throws InvalidCaproverServerInfoException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getAuthToken(): void
    {
        $client = new Client(['verify' => true]);
        try {
            $response = $client->post($this->server . '/login', ['json' => ['password' => $this->password],
                'headers' => ['x-namespace' => 'captain']]);
            $this->token = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR)?->data?->token;
            if (!is_string($this->token)) {
                throw new CannotGetTokenException();
            }
        } catch (Exception $e) {
            throw new InvalidCaproverServerInfoException($e->getMessage());
        }
    }


}
