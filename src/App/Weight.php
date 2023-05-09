<?php

namespace App;

class Weight implements WhateverInterface
{
    const GRAVITY = 12;

    protected int $gravity;

//    /**
//     * @param int $mass
//     */
//    public function __construct(int $gravity = null)
//    {
//        $this->gravity = $gravity ?? self::GRAVITY;
//    }

    public function calculateWeight(int $mass): int
    {
        return $mass * self::GRAVITY;
    }

//    public function setMass(int $mass): Weight
//    {
//        $this->mass = $mass;
//
//        return $this;
//    }
}