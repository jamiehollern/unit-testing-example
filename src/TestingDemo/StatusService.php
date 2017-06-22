<?php

namespace TestingDemo;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Exception;

/**
 * Class DemoService
 * @package TestingDemo
 */
final class StatusService
{

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $client;

    /**
     * DemoService constructor.
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $url
     * @return bool
     * @throws \Exception
     */
    public function siteStatus(string $url): bool
    {
        $response = $this->client->request('GET', $url,
          ['http_errors' => false]);
        if (!$response instanceof ResponseInterface) {
            throw new Exception('Connection interrupted.');
        }
        $status_code = (string)$response->getStatusCode();
        if (strpos($status_code, '2') === 0) {
            return true;
        }
        return false;
    }

}
