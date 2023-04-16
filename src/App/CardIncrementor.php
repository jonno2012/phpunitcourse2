<?php

namespace App;

class CardIncrementor
{
    protected int $numberToIncrementBy;

    /**
     * @param int $numberToIncrementBy
     */
    public function __construct(int $numberToIncrementBy = 0)
    {
        $this->numberToIncrementBy = $numberToIncrementBy;
    }

    public function increment(int $number): int
    {
        return $number + $this->numberToIncrementBy;
    }
}