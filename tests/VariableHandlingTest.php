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
}
