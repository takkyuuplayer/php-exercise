<?php

namespace Tests\GuzzleHttp;

use GuzzleHttp\Client;

class ClientTest extends \PHPUnit\Framework\TestCase
{
    public function test_Client_with_base_uri()
    {
        $client = new Client(
            [
                'base_uri' => 'https://github.com/',
            ]
        );

        $baseUri = $client->getConfig('base_uri');

        $this->assertInstanceOf(
            'GuzzleHttp\Psr7\Uri',
            $baseUri
        );

        $client->request('GET', 'takkyuuplayer', ['foo' => 'bar']);
    }
}
