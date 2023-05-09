<?php

namespace App;

class EarthlyObject
{
    protected int $mass;
    protected int $weight;
    protected WhateverInterface $whatever;
    /**
     * @param int $mass
     */
    public function __construct(int $mass, WhateverInterface $whatever)
    {
        $this->mass = $mass;
        $this->whatever = $whatever;
    }

    public function setWeight(): EarthlyObject
    {
        $weight = $this->whatever->calculateWeight($this->mass);

        $this->weight = $this->changeWeight($weight);

        return $this;
    }

    public function changeWeight(int $weight): int
    {
        return $weight / 2;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }


}