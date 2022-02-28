<?php

namespace Ariaieboy\CaproverSdk;


use Ariaieboy\CaproverSdk\Exceptions\CannotGetTokenException;
use Ariaieboy\CaproverSdk\Exceptions\CaproverApiCallErrorException;
use Ariaieboy\CaproverSdk\Exceptions\CaproverErrorException;
use Ariaieboy\CaproverSdk\Exceptions\InvalidCaproverServerInfoException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CaproverSdk
{
    protected ?string $token = null;
    protected Client $client;

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws InvalidCaproverServerInfoException
     */
    public function __construct(protected string $server, protected string $password, $timeout = 60)
    {
        $this->server = rtrim($this->server, '/') . '/api/v2/';
        $this->getAuthToken();
        $this->client = new Client(['base_uri' => $this->server, 'verify' => true, 'timeout' => $timeout, 'headers' => [
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
        $client = new Client(['base_uri' => $this->server, 'verify' => true]);
        try {
            $response = $client->post('login', ['json' => ['password' => $this->password],
                'headers' => ['x-namespace' => 'captain']]);
            $data = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
            if ((int)$data->status !== CaproverApiStatus::OKAY) {
                throw new CaproverApiCallErrorException($data->description ?? '');
            }
            $this->token = $data->data->token;
        } catch (Exception $e) {
            throw new InvalidCaproverServerInfoException($e->getMessage());
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws CaproverApiCallErrorException
     */
    public function attachNewCustomDomainToApp(string $appName, string $customDomain): bool
    {
        $clearedCustomDomain = $this->getHost($customDomain);
        try {
            $response = $this->client->post('user/apps/appDefinitions/customdomain', ['json' => [
                'appName' => $appName,
                'customDomain' => $clearedCustomDomain
            ]]);
            $data = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
            if ($data->status === 100) {
                return true;
            }
            throw new CaproverErrorException(message: $data->description ?? '', code: $data->status);
        } catch (GuzzleException $e) {
            throw new CaproverApiCallErrorException($e->getMessage());
        }
    }

    /**
     * @throws CaproverErrorException
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function enableSslForCustomDomain(string $appName, string $customDomain): bool
    {
        $clearedCustomDomain = $this->getHost($customDomain);
        try {
            $response = $this->client->post('user/apps/appDefinitions/enablecustomdomainssl', ['json' => [
                'appName' => $appName,
                'customDomain' => $clearedCustomDomain
            ]]);
            $data = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
            if ($data->status === 100) {
                return true;
            }
            throw new CaproverErrorException(message: $data->description ?? '', code: $data->status);
        } catch (GuzzleException $e) {
            throw new CaproverApiCallErrorException($e->getMessage());
        }
    }

    /**
     * @throws CaproverErrorException
     * @throws CaproverApiCallErrorException
     * @throws \JsonException
     */
    public function removeCustomDomain(string $appName, string $customDomain): bool
    {
        $clearedCustomDomain = $this->getHost($customDomain);
        try {
            $response = $this->client->post('user/apps/appDefinitions/removecustomdomain', ['json' => [
                'appName' => $appName,
                'customDomain' => $clearedCustomDomain
            ]]);
            $data = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
            if ($data->status === 100) {
                return true;
            }
            throw new CaproverErrorException(message: $data->description ?? '', code: $data->status);
        } catch (GuzzleException $e) {
            throw new CaproverApiCallErrorException($e->getMessage());
        }
    }

    /**
     * @param string $customDomain
     * @return mixed
     */
    public function getHost(string $customDomain): mixed
    {
        return parse_url($customDomain)['host'];
    }
}
