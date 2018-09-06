<?php

use PHPUnit\Framework\TestCase;

class VariableHandlingTest extends TestCase
{
    public function testIsset()
    {
        $this->assertFalse(isset($undefined));

        $null = null;
        $this->assertFalse(isset($null));

        $false = false;
        $this->assertTrue(isset($false));
    }

    public function testEmpty()
    {
        $this->assertTrue(empty(0));
        $this->assertTrue(empty(null));
        $this->assertTrue(empty($undefined));
        $this->assertTrue(empty(false));
        $this->assertTrue(empty(''));
        $this->assertTrue(empty('0'));

        $this->assertFalse(empty('1'));
    }
}
