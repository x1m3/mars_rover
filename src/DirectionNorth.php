<?php

namespace Marsrover;


/**
 * Class DirectionNorth
 * @package Marsrover
 */
class DirectionNorth implements Idirection
{
    /**
     * @return DirectionWest
     */
    public function turnLeft()
    {
        return new DirectionWest();
    }

    /**
     * @return DirectionEast
     */
    public function turnRight()
    {
        return new DirectionEast();
    }

    public function name()
    {
        return DirectionEnums::NORTH;
    }
}