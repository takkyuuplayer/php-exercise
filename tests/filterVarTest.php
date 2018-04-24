<?php

use PHPUnit\Framework\TestCase;

class stdClassTest extends TestCase
{
    public function testFilter_var()
    {
        $url = '/etc/passwd';

        $this->assertFalse(filter_var($url, FILTER_VALIDATE_URL));

        $url = 'ssh://etc/passwd';

        $this->assertSame('ssh://etc/passwd', filter_var($url, FILTER_VALIDATE_URL));
    }
}
