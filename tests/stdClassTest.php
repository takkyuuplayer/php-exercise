<?php
use PHPUnit\Framework\TestCase;

class StdClassTest extends TestCase
{
    public function testStdClassInstance()
    {
        $k = new stdClass();
        $k->id = 5;

        $this->assertInstanceOf('stdClass', $k);
        $this->assertSame(5, $k->id);
    }

    public function testStdClassToJSON()
    {
        $k = new stdClass();
        $k->id = 5;
        $k->foo = '5';

        $this->assertSame('{"id":5,"foo":"5"}', json_encode($k));
    }
}

