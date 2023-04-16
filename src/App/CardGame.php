<?php

namespace App;

use App\Exceptions\SetCardsException;

class CardGame
{
    const SUITS = ['hearts', 'diamonds', 'clubs', 'spades'];
    const PICTURE_CARDS = ['jack', 'queen', 'king'];
    const OTHER_CARDS = [[
        'name' => 'Ace',
        'position' => 1
    ]];
    const LOWEST_NUMERICAL_CARD = 2;
    const HIGHEST_NUMERICAL_CARD = 10;
    protected CardIncrementor $cardIncrementor;
    protected array $suits;
    protected array $pictureCards;
    protected array $otherCards;
    protected int $highestNumericalCard;
    protected array $cards = [];

    /**
     * @param array|string[] $suits
     * @param array|string[] $pictureCards
     * @param array|array[] $otherCards
     */
    public function __construct(
        CardIncrementor $cardIncrementor,
        array $suits = null,
        array $pictureCards = null,
        array $otherCards = null,
        int   $highestNumericalCard = null,
    )
    {
        $this->cardIncrementor = $cardIncrementor;
        $this->suits = $suits ?? self::SUITS;
        $this->pictureCards = $pictureCards ?? self::PICTURE_CARDS;
        $this->otherCards = $otherCards ?? self::OTHER_CARDS;
        $this->highestNumericalCard = $highestNumericalCard ?? self::HIGHEST_NUMERICAL_CARD;
    }

    /**
     * @return array
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @return array
     */
    public function getSuits(): array
    {
        return $this->suits;
    }

    /**
     * @return array
     */
    public function getPictureCards(): array
    {
        return $this->pictureCards;
    }

    /**
     * @return array
     */
    public function getOtherCards(): array
    {
        return $this->otherCards;
    }

    public function selectCard(array $cards, int $index = null): string
    {
        $index = $index ?? rand(0, count($cards) - 1);
        return $cards[$index];
    }

    public function setCards(): CardGame
    {
        try {
            foreach ($this->suits as $suit) {
                $cards = [];
                $cards = array_merge($cards, $this->setNumericalCards($suit));
                $cards = array_merge($cards, $this->pictureCards($suit));
                $cards = $this->setOtherCards($cards, $suit);

                $this->cards = array_merge($this->cards, $cards);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $this;
    }

    public function setNumericalCards(string $suit): array
    {
        $cards = [];

        for ($i = self::LOWEST_NUMERICAL_CARD; $i <= $this->cardIncrementor->increment($this->highestNumericalCard); $i++) {
            $cards[] = $i . ' of ' . ucfirst($suit);
        }

        return $cards;
    }

    public function pictureCards(string $suit): array
    {
        $pictureCards = [];

        foreach ($this->pictureCards as $pictureCard) {
            $pictureCards[] = ucfirst($pictureCard) . ' of ' . ucfirst($suit);
        }

        return $pictureCards;
    }

    /**
     * @param array $existingCards
     * @param string $suit
     * @return array
     * @throws \Exception
     */
    public function setOtherCards(array $existingCards, string $suit): array
    {
        foreach ($this->otherCards as $otherCard) {

            $position = ($otherCard['position'] > 0)
                ? $otherCard['position']
                : throw new SetCardsException('Position must be greater than zero for ' . $otherCard['name']);

            $firstSlice = array_slice($existingCards, 0, $position - 1);
            $secondSlice = array_slice($existingCards, $position - 1);
            $firstSlice[] = $otherCard['name'] . ' of ' . ucfirst($suit);
            $existingCards = array_merge($firstSlice, $secondSlice);

        }

        return $existingCards;
    }
}