<?php


use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class WeatherMonitorTest extends MockeryTestCase
{
//    public function testCorrectAverageIsReturned()
//    {
//        $service = $this->createMock(TemperatureService::class);
//
//        $map = [
//            ['12:00'],
//            ['14:00']
//        ];
//
//        $service->expects($this->exactly(2))
//            ->method('getTemperature')
//        ->will($this->returnValueMap($map));
//
//        $weather = new WeatherMonitor($service);
//
//        $this->assertEquals(23, $weather->getAverageTemperature('12:00', '14:00'));
//    }

    public function testCorrectAverageIsReturnedWithMockery()
    {
        $service = Mockery::mock(TemperatureService::class);
        // expectations:
        $service->shouldReceive('getTemperature')->once()->with('12:00')->andReturn(20); // should receive this argument and be called once
        $service->shouldReceive('getTemperature')->once()->with('14:00')->andReturn(26);
        $weather = new WeatherMonitor($service);

        $this->assertEquals(23, $weather->getAverageTemperature('12:00', '14:00'));
    }
}
