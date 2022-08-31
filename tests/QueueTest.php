<?php


use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    protected static $queue;

    /*
     * For simple setups
     */
    protected function setUp(): void
    {
        static::$queue->clear();
    }
//
    protected function tearDown(): void
    {
        static::$queue->clear();
    }
    /*
     * Executed once before first test is run. used for time consuming, expensive operations
     */
    public static function setUpBeforeClass(): void
    {
        static::$queue = new Queue;
    }

    public static function tearDownAfterClass(): void
    {
        static::$queue = null;
    }

    public function testNewQueueIsEmpty()
    {
        $this->assertEquals(0, static::$queue->getCount());
    }

    public function testItemIsAddedToQueue()
    {
        static::$queue->push('green');

        $this->assertEquals(1, static::$queue->getCount());
    }

    public function testItemIsRemovedQueue()
    {
        static::$queue->push('green');
        $item = static::$queue->pop();

        $this->assertEquals('green', $item);
    }

    public function testItemIsRemovedFromFrontOfQueue()
    {
        static::$queue->push('first');
        static::$queue->push('second');

        $this->assertEquals('first', static::$queue->pop());
    }

    public function testMaxNumberOfItemsCanBeAdded()
    {
        for ($i = 0; $i < Queue::MAX_ITEMS; $i++) {
            static::$queue->push($i);
        }

        $this->assertEquals(Queue::MAX_ITEMS, static::$queue->getCount());
    }

    public function testExceptionThrownWhenAddingTooMAnyItems()
    {
        for ($i = 0; $i < Queue::MAX_ITEMS; $i++) {
            static::$queue->push($i);
        }
        $this->expectException(QueueException::class);
        $this->expectExceptionMessage("Queue is full");

        static::$queue->push('wafer thin mint');
    }
}
