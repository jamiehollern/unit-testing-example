<?php

namespace TestingDemo\Tests;

use PHPUnit\Framework\TestCase;
use TestingDemo\StatusService;

class StatusServiceTest extends TestCase
{

    /**
     * @var \TestingDemo\StatusService
     */
    private $object;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $client;

    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;

    /**
     * Set up the tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->client = \Mockery::mock('GuzzleHttp\ClientInterface');
        $this->response = \Mockery::mock('Psr\Http\Message\ResponseInterface');
        $this->object = new StatusService($this->client);
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @test
     */
    public function testNetworkInterrupt()
    {
        $this->client->shouldReceive('request')->andReturn(null);
        $this->expectException(\Exception::class);
        $this->object->siteStatus('https://google.co.uk');
    }

    /**
     * @test
     */
    public function testStatusTrue()
    {
        $this->client->shouldReceive('request')->andReturn($this->response);
        $this->response->shouldReceive('getStatusCode')->andReturn(200);
        $actual = $this->object->siteStatus('https://google.co.uk');
        $expected = true;
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @dataProvider responseProvider
     */
    public function testStatusMultipleValues($responseCode, $expected)
    {
        $this->client->shouldReceive('request')->andReturn($this->response);
        $this->response->shouldReceive('getStatusCode')
          ->andReturn($responseCode);
        $actual = $this->object->siteStatus('https://google.co.uk');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Data provider - HTTP status codes and expected method return values.
     * @return array
     */
    public function responseProvider()
    {
        return [
          [200, true],
          [201, true],
          [301, false],
          [404, false],
          [500, false]
        ];
    }

}
