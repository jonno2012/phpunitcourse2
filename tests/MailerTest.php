<?php


use PHPUnit\Framework\TestCase;
//use InvalidArgumentException

class MailerTest extends TestCase
{
    // as this ia a static method we don't instatntiate a method
    public function testSendMessageReturnsTrue()
    {
        $this->assertTrue(App\Mailer::send('test@test.com', 'Hello!'));
    }
//
//    public function testInvalidArgumentExceptionIfArgumentIsEmpty()
//    {
//        $this->expectException(InvalidArgumentException::class);
//
//        App\Mailer::send('', '');
//    }

    public function testDummy()
    {
        $this->assertEquals(true, true);
}
}
