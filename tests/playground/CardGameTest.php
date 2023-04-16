<?php

namespace playground;

use App\CardGame;
use App\Exceptions\SetCardsException;
use PHPUnit\Framework\TestCase;

class CardGameTest extends TestCase
{
    protected CardGame $cardGame;
    protected array $testCards = ['card 1', 'card 2', 'card 3', 'card 4'];

    public function setUp(): void
    {
        $this->cardGame = new CardGame();
    }

    public function testCardGameConstructorSetsTheClassPropertiesSuccessfully()
    {
        $this->assertEquals(CardGame::SUITS, $this->cardGame->getSuits());
        $this->assertEquals(CardGame::PICTURE_CARDS, $this->cardGame->getPictureCards());
        $this->assertEquals(CardGame::OTHER_CARDS, $this->cardGame->getOtherCards());
    }

    public function testSetOtherCardsFunctionsProperly()
    {
        $cardsIncludingOtherCards = (new CardGame())->setOtherCards($this->testCards, 'Hearts', [['name' => 'Test Card', 'position' => 1]]);
        $cardsIncludingOtherCards2 = (new CardGame())->setOtherCards($this->testCards, 'Hearts', [['name' => 'Test Card', 'position' => 3]]);

        $this->assertEquals(['Test Card of Hearts', 'card 1', 'card 2', 'card 3', 'card 4'], $cardsIncludingOtherCards);
        $this->assertEquals(['card 1', 'card 2', 'Test Card of Hearts', 'card 3', 'card 4'], $cardsIncludingOtherCards2);
    }

    public function testSetOtherCardsThrowsExceptionWithPositionZero()
    {
        $otherCardsToAdd = [['name' => 'Test Card', 'position' => 0]];

        $this->expectException(SetCardsException::class);
        $this->expectExceptionMessage("Position must be greater than zero for Test Card");

        (new CardGame())->setOtherCards($this->testCards, 'Hearts', $otherCardsToAdd);
    }
}
