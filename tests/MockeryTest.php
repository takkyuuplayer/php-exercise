<?php
use \PHPUnit\Framework\TestCase;

class MockeryTest extends TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function testShouldReceive()
    {
        $service = Mockery::mock('service');
        $service->shouldReceive('readTemp')
            ->times(3)
            ->andReturn(10, 12, 14);

        $this->assertEquals(10, $service->readTemp());
        $this->assertEquals(12, $service->readTemp());
        $this->assertEquals(14, $service->readTemp());
    }
}
