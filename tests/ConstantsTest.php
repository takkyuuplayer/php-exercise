<?php

namespace Tests;

class ConstantsTest extends \PHPUnit\Framework\TestCase
{
    public function test_Namespace()
    {
        $this->assertSame(
            'Tests',
            __NAMESPACE__
        );
    }

    public function test_Class()
    {
        $this->assertSame(
            'Tests\ConstantsTest',
            __CLASS__
        );
    }

    public function test_Method()
    {
        $this->assertSame(
            'Tests\ConstantsTest::test_Method',
            __METHOD__
        );
    }

    public function test_Line()
    {
        $this->assertSame(
            35,
            __LINE__
        );
    }
}
