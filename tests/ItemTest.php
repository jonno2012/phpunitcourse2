<?php


use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testDescriptionIsNotEmpty()
    {
        $item = new Item;

        $this->assertNotEmpty(($item->getDescription()));
    }

    // you can test protected functions by extending class and changing scope in child. not private.
    protected function testIdIsAnInteger()
    {
        $item = new ItemChild;

        $this->assertIsInt($item->getID());
    }

    // how to test a private method. create a child class and set the method to 'accessible' using the reflection class
    public function testTokenIsString()
    {
        $item = new ItemChild;

        $reflector = new ReflectionClass(Item::class);

        $method = $reflector->getMethod('getToken');
        $method->setAccessible(true);
        $result = $method->invoke($item);

        $this->assertIsString($result);
    }

    public function testPrefixTokenStartsWithString()
    {
        $item = new ItemChild;

        $reflector = new ReflectionClass(Item::class);

        $method = $reflector->getMethod('getPrefixedToken');
        $method->setAccessible(true);

        $result = $method->invokeArgs($item, ['example']);

        $this->assertStringStartsWith('example', $result);
    }
}

// some believe private or protected methods should not be tested. However, when a class extends another class with
// protected or private methods, the parent class is technically offering a public interface and so the methods should
// be tested.

// private methods should be tested indirectly using the public methods which call them. if this is difficult then it
// could be a sign that your class needs to be refactored or even extended. you should interact with a class for testing
// by only using it's public methods.
