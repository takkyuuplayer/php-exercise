<?php

use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    public function testDATE_ISO8601()
    {
        $this->assertSame(
            '2018-05-29T17:00:00-0700',
            date(DATE_ISO8601),
            ''
        );
    }

    public function test_date()
    {
        echo date('Y-m-dTH:i:sZ');
    }
}
