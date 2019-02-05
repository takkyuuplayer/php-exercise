<?php

use PHPUnit\Framework\TestCase;

class ClosureTest extends TestCase
{
    public function testThisObjectInClosure()
    {
        $closure = function () {
            return get_class($this);
        };

        $this->assertSame(__CLASS__, $closure());
    }
}
