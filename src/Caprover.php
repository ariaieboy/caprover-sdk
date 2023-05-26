<?php

namespace Ariaieboy\Caprover;

use Ariaieboy\Caprover\Common\CaproverAuthenticator;
use Ariaieboy\Caprover\Requests\AttachNewCustomDomainToApp;
use Ariaieboy\Caprover\Requests\EnableSslForCustomDomain;
use Ariaieboy\Caprover\Requests\ForceSsl;
use Ariaieboy\Caprover\Requests\GetAuthToken;
use Ariaieboy\Caprover\Requests\GetCaptainInfo;
use Ariaieboy\Caprover\Requests\RemoveCustomDomain;
use Ariaieboy\Caprover\Requests\UpdateRootDomain;
use Ariaieboy\Caprover\Responses\CaproverResponse;
use JsonException;
use ReflectionException;
use Saloon\Contracts\MockClient;
use Saloon\Contracts\Request;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Http\Connector;
use Throwable;

/**
 * @method send(Request $request, MockClient $mockClient = null)
 * @returns CaproverResponse
 */
class Caprover extends Connector
{
    private ?string $authToken = null;
    protected ?string $response = CaproverResponse::class;

    public function __construct(readonly protected string $server, readonly protected string $password, protected int $timeout = 60)
    {
    }

    public function hasRequestFailed(\Saloon\Contracts\Response $response): ?bool
    {
        return ($response->json('status') > 101);
    }

    /**
     * @throws InvalidResponseClassException
     * @throws ReflectionException
     * @throws PendingRequestException
     */
    public function getAuthToken(): CaproverResponse
    {
        return $this->send(new GetAuthToken($this->password));
    }

    /**
     * @throws InvalidResponseClassException
     * @throws JsonException
     * @throws PendingRequestException
     * @throws ReflectionException
     * @throws Throwable
     */
    public function attachNewCustomDomainToApp(string $appName, string $customDomain): CaproverResponse
    {
        $request = new AttachNewCustomDomainToApp($appName, $customDomain);
        $request->authenticate(new CaproverAuthenticator($this->getLastRememberedToken()));
        return $this->send($request);
    }

    /**
     * @throws InvalidResponseClassException
     * @throws Throwable
     * @throws ReflectionException
     * @throws PendingRequestException
     * @throws JsonException
     */
    public function enableSslForCustomDomain(string $appName, string $customDomain): CaproverResponse
    {
        $request = new EnableSslForCustomDomain($appName, $customDomain);
        $request->authenticate(new CaproverAuthenticator($this->getLastRememberedToken()));
        return $this->send($request);
    }

    /**
     * @throws InvalidResponseClassException
     * @throws Throwable
     * @throws ReflectionException
     * @throws PendingRequestException
     * @throws JsonException
     */
    public function forceSsl(bool $isEnabled): CaproverResponse
    {
        $request = new ForceSsl($isEnabled);
        $request->authenticate(new CaproverAuthenticator($this->getLastRememberedToken()));
        return $this->send($request);
    }

    /**
     * @throws InvalidResponseClassException
     * @throws Throwable
     * @throws ReflectionException
     * @throws PendingRequestException
     * @throws JsonException
     */
    public function updateRootDomain(string $rootDomain): CaproverResponse
    {
        $request = new UpdateRootDomain($rootDomain);
        $request->authenticate(new CaproverAuthenticator($this->getLastRememberedToken()));
        return $this->send($request);
    }

    /**
     * @throws InvalidResponseClassException
     * @throws Throwable
     * @throws ReflectionException
     * @throws PendingRequestException
     * @throws JsonException
     */
    public function getCaptainInfo(): CaproverResponse
    {
        $request = new GetCaptainInfo();
        $request->authenticate(new CaproverAuthenticator($this->getLastRememberedToken()));
        return $this->send($request);
    }

    /**
     * @throws InvalidResponseClassException
     * @throws Throwable
     * @throws ReflectionException
     * @throws PendingRequestException
     * @throws JsonException
     */
    public function removeCustomDomain(string $appName, string $customDomain): CaproverResponse
    {
        $request = new RemoveCustomDomain($appName, $customDomain);
        $request->authenticate(new CaproverAuthenticator($this->getLastRememberedToken()));
        return $this->send($request);
    }

    public function resolveBaseUrl(): string
    {
        return rtrim($this->server, '/') . '/api/v2';
    }

    protected function defaultHeaders(): array
    {
        return [
            'x-namespace' => 'captain'
        ];
    }

    /**
     * @throws InvalidResponseClassException
     * @throws Throwable
     * @throws ReflectionException
     * @throws PendingRequestException
     * @throws JsonException
     */
    protected function getLastRememberedToken(): string
    {
        if (!is_null($this->authToken)) {
            return $this->authToken;
        }
        $getToken = $this->getAuthToken();
        $getToken->throw();
        $this->authToken = $getToken->json('data.token');
        return $this->authToken;
    }

    protected function defaultConfig(): array
    {
        return [
            'timeout' => $this->timeout
        ];
    }
}
