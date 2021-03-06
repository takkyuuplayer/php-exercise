<?php

namespace Tests;

class NetUrl2Test extends \PHPUnit\Framework\TestCase
{
    public function testNetUrl2Test()
    {
        $uri = new \Net_URL2('https://www.example.com/foo/bar/index.php?foo=bar');

        $this->assertSame('www.example.com', $uri->getHost());
        $this->assertSame(false, $uri->getPort());
    }
}
