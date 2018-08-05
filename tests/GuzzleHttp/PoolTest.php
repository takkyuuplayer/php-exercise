<?php

namespace Tests\GuzzleHttp;

use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class PoolTest extends \PHPUnit\Framework\TestCase
{
    public function testPool()
    {
        $client = new Client();
        $requests = function ($total) {
            for ($i = 0; $i < $total; $i++) {
                yield new Request('GET', 'https://foo.google.co.jp');
            }
        };

        $pool = new Pool(
            $client,
            $requests(10),
            [
                'concurrency' => 2,
                'fulfilled' => function ($response, $index) {
                    $this->assertSame(200, $response->getStatusCode());
                },
                'rejected' => function ($exception, $index) {
                    $this->assertNull($exception->getResponse());
                }
            ]
        );

        $promise = $pool->promise();
        $promise->wait();
    }
}
