<?php

use PHPUnit\Framework\TestCase;

class stdClassTest extends TestCase
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

    public function testStdClassInArray()
    {
        $arr = [
            (object) ['num' => 1],
            (object) ['num' => 2],
        ];

        foreach ($arr as $std) {
            $std->num = 2 * $std->num;
        }

        $this->assertSame(2, $arr[0]->num, 'foreach with reference');
        $this->assertSame(4, $arr[1]->num, 'foreach with reference');

        $arr = [
            ['num' => 1, 'nest' => ['num' => 1]],
            ['num' => 2, 'nest' => ['num' => 2]],
        ];

        foreach ($arr as $row) {
            $row['num'] = 2 * $row['num'];
            $row['nest']['num'] = 2 * $row['nest']['num'];
        }

        $this->assertSame(1, $arr[0]['num'], 'foreach with copy');
        $this->assertSame(2, $arr[1]['num'], 'foreach with copy');

        $this->assertSame(1, $arr[0]['nest']['num'], 'foreach with copy');
        $this->assertSame(2, $arr[1]['nest']['num'], 'foreach with copy');
    }

    public function testJsonDecode()
    {
        $arr = [
            'id'      => 1,
            'friends' => [1, 2, 3],
            'parents' => [
                'father' => 4,
                'mother' => 5,
            ],
            'mixed' => [
                1,
                'foo' => 'bar',
            ],
        ];

        $std = json_decode(json_encode($arr));

        $this->assertEquals(1, $std->id);
        $this->assertEquals([1, 2, 3], $std->friends);
        $this->assertEquals((object) ['father' => 4, 'mother' => 5], $std->parents);
        $this->assertEquals((object) ['0' => 1, 'foo' => 'bar'], $std->mixed);
    }

    public function testAssertContain()
    {
        $obj = (object) ['id' => 1];
        $obj2 = (object) ['id' => 1];

        $this->assertContains($obj, [$obj]);

        $this->assertNotContains($obj, [(object) ['id' => 1]]);
    }
}
