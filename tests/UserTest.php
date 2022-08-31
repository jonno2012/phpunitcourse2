<?php

//use Mockery;

class UserTest extends \Mockery\Adapter\Phpunit\MockeryTestCase
{
    public function testReturnsFullName()
    {
        $user = new User();

        $user->first_name = "Teresa";
        $user->surname = "Green";

        $this->assertEquals('Teresa Green', $user->getFullName());
   }

    public function testFullNameIsEmptyByDefault()
    {
        $user = new User();

        $this->assertEquals('', $user->getFullName());
   }

    public function testUserHasFirstName()
    {
        $user = new User();

        $user->first_name = "Teresa";

        $this->assertEquals('Teresa', $user->first_name);
   }

    public function testNotificationIsSent()
    {
        $user = new User;

        $mock_mailer = $this->createMock(Mailer::class);

        $mock_mailer->expects($this->once())
            ->method('sendMessage')
            ->with($this->equalTo('david@test.com'), $this->equalTo('Hello'))
            ->willReturn(true);

        $user->setMailer($mock_mailer);
        $user->email = 'david@test.com';

        $this->assertTrue($user->notify('Hello'));
   }

    public function testCannotNotifyUserWithNoEmail()
    {
        // granular control over mock objects
        $user = new User;
        $user->email = 'test@test.com';
        // sometimes you might want to
        $mock_mailer = $this->getMockBuilder(Mailer::class)
//            ->onlyMethods([])
            ->getMock();

        $mock_mailer->method('sendMessage')
            ->will($this->throwException(new \Exception));

        $user->setMailer($mock_mailer);

        $this->expectException(\Exception::class);

        $user->notify("Hello");
   }

    public function testNotifyReturnsTrue()
    {
        $user = new App\User('test@test.com');
// you can only stub instance methods with phpunit mocking methods, not static methods.
        $mailer = $this->createMock(App\Mailer::class);

        $user->setMailer($mailer);

        $user->setMailerCallable(function() {
            echo 'mcoked';
            return true;
        });

        $this->assertTrue($user->notify('Hello!'));
   }
   // you cannot invoke a static method on a mock object. one option is to simply refactor to make the method an instance method.
    //
    // in a scenario where this is not possible, say if you are using an external library which uses a static method, the static method
    // can be passed using a callable method. here, rather than making a stub for the method, we simply pass an anonymous function to simulate
    // a stub method in place of the callable method. it seems a bit convoluted but it gets around the problem of not being able to mock static
    // functions

    // Mockery intercepts the class when it is being autoloaded by autoloader. With Mockery you can stub static methods
//    public function testNotifyReturnsTrueUsingMockery()
//    {
//        $user = new App\User('test@test.com');
//
//        // Mockery uses class 'aliases' to allow creating stubs of static methods.
//        $mock = Mockery::mock('alias:App\Mailer');
//
//        $mock->shouldReceive('send')
//            ->once()
//            ->with($user->email, 'Hello!')
//            ->andReturn(true);
//
//        $this->assertTrue($user->notify('A Message'));
//
//        // although this works, getting mockery to intercept the autoloader in this way can cause issues. It is recommended, therefore,
//        // to use one of the other methods for testing static methods (change to instance method or use callback)
//    }

    public function tearDown(): void
    {
        Mockery::close();;
    }
}



// you can't mock static methods.