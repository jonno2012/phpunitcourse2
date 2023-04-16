<?php

namespace playground;

use App\CardGame;
use PHPUnit\Framework\TestCase;

class CardGameObjectTest extends TestCase
{
    protected CardGame $cardGame;

    public function setUp(): void
    {
        $this->cardGame = new CardGame(
            ['hearts', 'diamonds'],
            ['jack'],
            [[
                'name' => 'Ace',
                'position' => 2
            ]],
        3
        );

        $this->cardGame->setCards();
    }

    public function testClassReturnsCorrectResults()
    {
        $this->assertEquals(['hearts', 'diamonds'], $this->cardGame->getSuits());
        $this->assertEquals(['jack'], $this->cardGame->getPictureCards());
        $this->assertEquals([[
            'name' => 'Ace',
            'position' => 2
        ]], $this->cardGame->getOtherCards());
    }

    public function testGetCardsReturnsExpectedNumberOfCards()
    {
        $cards = $this->cardGame->getCards();
        $this->assertEquals(8, count($cards));
    }

    public function testSetNumericalCards()
    {
        $numericCards = $this->cardGame->setNumericalCards('spades');
        $this->assertEquals(
            [
                '2 of Spades',
                '3 of Spades'
            ],
            $numericCards
        );
    }

    public function testSetsPictureCardsCorrectly()
    {
        $pictureCards = $this->cardGame->pictureCards('spades');
        $this->assertEquals(
            [
                'Jack of Spades'
            ],
            $pictureCards
        );
    }

    public function testSetOtherCards()
    {
        $otherCards = $this->cardGame->setOtherCards(
            [
                'Test1',
                'Test2',
                'Test3'
            ],
            'spades');

        $this->assertEquals(
            [
                'Test1',
                'Ace of Spades',
                'Test2',
                'Test3'
            ], $otherCards);
    }

}
