<?php
use PHPUnit\Framework\TestCase;

class HelloTest extends TestCase
{
    public function testAssetTrue()
    {
        $this->assertTrue(true);

        $arr['null'] = null;

        $this->assertTrue(array_key_exists('null', $arr));
        $this->assertFalse(isset($arr['null']));
    }
}
