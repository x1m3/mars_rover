<?php

namespace Marsrover;


/**
 * Class DirectionSouth
 * @package Marsrover
 */
class DirectionSouth implements Idirection
{
    /**
     * @return DirectionEast
     */
    public function turnLeft()
    {
        return new DirectionEast();
    }

    /**
     * @return DirectionWest
     */
    public function turnRight()
    {
        return new DirectionWest();
    }
}