<?php

namespace Ariaieboy\CaproverSdk;


use Ariaieboy\CaproverSdk\Exceptions\CannotGetTokenException;
use Ariaieboy\CaproverSdk\Exceptions\InvalidCaproverServerInfoException;
use Exception;
use GuzzleHttp\Client;

class CaproverSdk
{
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
