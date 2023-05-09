<?php

namespace playground;

use PHPUnit\Framework\TestCase;
use App\EarthlyObject;
use App\Weight;
class EarthlyObjectTest extends TestCase
{
//    protected EarthlyObject $earthlyObject;
//    public function setUp()
//    {
//        $this->earthlyObject = new EarthlyObject(30);
//    }
    public function testEarthlyObjectSetWeightObjectSetsTheCorrectWeight()
    {
        $weightMock = $this->createMock(Weight::class);
        // createStub basically does the same thing as createMock but should be used instead of createMock
        // where what you are getting from the method is simple stub data.

        $weightMock->expects($this->exactly(1)) // see matcher methods docs in the phpunit github source code
            ->method('calculateWeight')
//            ->with(100)
            ->willReturn(360);

        $weight = (new EarthlyObject(30, $weightMock))->setWeight()->getWeight();

        $this->assertSame(180, $weight);
    }

//    public function testEarthlyObjectSetWeightObjectSetsTheCorrectWeightFeature()
//    {
//        $weight = $this->getMockBuilder(Weight::class)->disableOriginalConstructor()->getMock();
//
////        $weight->method('calculateWeight')
//////            ->with(100)
////            ->willReturn(360);
//
//        $weight = (new EarthlyObject(30, $weight))->setWeight()->getWeight();
//
//
//
//        $this->assertSame(180, $weight);
//    }
}
