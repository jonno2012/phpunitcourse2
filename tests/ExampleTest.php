<?php

use Mockery\Adapter\Phpunit\MockeryTestCase;

class ExampleTest extends MockeryTestCase
{
//    public function tearDown()
//    {
//        // Mockery::close() is required for mockery to work properly with phpunit unless test class extends Mockery as above.
//        Mockery::close();
//    }
    public function testAddingTwoAndTwo()
    {
        $this->assertEquals(4, 2 + 2);
    }

//    public function testUsingDirsWorksWithAutoload()
//    {
//        $testClass = new ArticleTest;
//
//        $this->assertEquals('testing', $testClass->testing());
//    }
}