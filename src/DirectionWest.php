<?php

namespace Marsrover;


/**
 * Class DirectionNorth
 * @package Marsrover
 */
class DirectionNorth implements Idirection
{
    /**
     * @return DirectionNorth
     */
    public function turnLeft()
    {
        return new DirectionNorth();
    }

    /**
     * @return DirectionSouth
     */
    public function turnRight()
    {
        return new DirectionSouth();
    }
}