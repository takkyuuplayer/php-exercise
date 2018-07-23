<?php

use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    public function testDate()
    {
        $this->assertSame('1970-01-01T00:00:00+0000', date(DATE_ISO8601, 0));
        $this->assertSame('1', date('U', 1));
    }
}
