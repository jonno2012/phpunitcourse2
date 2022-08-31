<?php


use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class OrderTest extends MockeryTestCase
{
//    public function testOrderIsProcessed()
//    {
//        // how to mock a non-existent class
//        $gateway = $this->getMockBuilder('PaymentGateway')
//            ->setMethods(['charge'])
//            ->getMock();
//
//        // test values passed to the non-existent class's mock method
//        $gateway->expects($this->once())
//            ->method('charge')
//            ->with($this->equalTo(200))
//            ->willReturn(true);
//
//        $order = new Order($gateway);
//        $order->amount = 200;
//
//        $this->assertTrue($order->process());
//    }
//
//    public function testOrderIsProcessedUsingMockery()
//    {
//        $gateway = Mockery::mock('PaymentGateway');
//
//        $gateway->shouldReceive('charge')
//            ->once()
//            ->with(200)
//            ->andReturn(true);
//
//
//        $order = new Order($gateway);
//        $order->amount = 200;
//
//        $this->assertTrue($order->process());
//    }

//    public function tearDown(): void
//    {
//        Mockery::close();
//    }

    public function testOrderIsProcessedUsingAMock()
    {
        $order = new Order(3, 1.99);

        $this->assertEquals(5.97, $order->amount);
        // this is called before test is run and is therefore an 'expectation'
        $gateway_mock = Mockery::mock('PaymentGateway');
        $gateway_mock->shouldReceive('charge')
            ->once()
            ->with(5.97);

        $order->process($gateway_mock);
    }

    public function testOrderIsProcessedUsingASpy()
    {
        $order = new Order(3, 1.99);

        $this->assertEquals(5.97, $order->amount);

        // spies can be easier to understand. however if you want to
        // return a value from a mock method, this cannot be done with spies, only mocks.
        // Also spies use more memory than mocks.
        $gateway_spy = Mockery::spy('PaymentGateway');

        $order->process($gateway_spy);

        $gateway_spy->shouldHaveReceived('charge')
            ->once()
            ->with(5.97);
    }
}
