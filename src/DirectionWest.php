<?php

namespace Marsrover;


/**
 * Class DirectionNorth
 * @package Marsrover
 */
class DirectionWest implements Idirection
{
    /**
     * @return DirectionSouth
     */
    public function turnLeft()
    {
        return new DirectionSouth();
    }

    /**
     * @return DirectionNorth
     */
    public function turnRight()
    {
        return new DirectionNorth();
    }
}