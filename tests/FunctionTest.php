<?php
require_once dirname(dirname(__FILE__)).'/functions.php';

class FunctionTest extends \PHPUnit\Framework\TestCase
{
    public function testAddReturnsTheCorrectSum()
    {
        $this->assertEquals(4, add(2,2));
        $this->assertEquals(8, add(3, 5));
    }

    public function testAddDoesNotReturnIncorrectSum()
    {
        $this->assertNotEquals(9, add(3, 5));
    }
}