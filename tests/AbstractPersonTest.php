<?php


use PHPUnit\Framework\TestCase;

class AbstractPersonTest extends TestCase
{
    // abstract methods can be tested via a child class containing the same implementation of the method.
    // PHPunit gives us another option for testing abstract methods:
    //
    public function testNameAndTitleIsReturned()
    {
        $doctor = new Doctor('Green');
        $this->assertEquals('Dr. Green', $doctor->getNameAndTitle());
    }

    public function testNameAndTitleIncludesValueFromGetTitle()
    {
        // when using getMockForAbstractClass, we don't mock concrete methods but we do mock abstract methods.
        $mock = $this->getMockBuilder(AbstractPerson::class)
            ->setConstructorArgs(['Green'])
            ->getMockForAbstractClass();

        $mock->method('getTitle')
            ->willReturn('Dr.');

        $this->assertEquals('Dr. Green', $mock->getNameAndTitle());
    }

    // So when testing a abstract class we create a mock object using getMock for abstract class, which mocks
    // or stubs the abstract methods but doesn't stub concrete methods which can be tested normally
}
