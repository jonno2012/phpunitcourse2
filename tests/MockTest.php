<?php


use PHPUnit\Framework\TestCase;

class MockTest extends TestCase
{
    public function testMock()
    {
        $mailer = new Mailer;
        $mock = $this->createStub(Mailer::class);
        $mock->method('sendMessage')
            ->willReturn(true);

        $result = $mock->sendMessage('test@test.com','Hello'); // stub method

        $this->assertTrue($result);
    }
}
