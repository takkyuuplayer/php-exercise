<?php

namespace Tests\GuzzleHttp;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class ClientTest extends \PHPUnit\Framework\TestCase
{
    public function test_Client_with_base_uri()
    {
        $client = new Client(
            [
                'base_uri' => 'http://127.0.0.1:8080/base/',
            ]
        );

        $baseUri = $client->getConfig('base_uri');

        $this->assertInstanceOf(
            'GuzzleHttp\Psr7\Uri',
            $baseUri
        );

        $client->request('GET', 'path', [ 'foo' => 'bar']);
    }
}
