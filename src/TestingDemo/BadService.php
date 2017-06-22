<?php

namespace TestingDemo;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Exception;

/**
 * Class BadService
 * @package TestingDemo
 */
final class BadService
{

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * BadService constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
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
        $status_code = $response->getStatusCode();
        if (strpos($status_code, '2') === 0) {
            return true;
        }
        return false;
    }

}
