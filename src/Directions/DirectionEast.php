<?php

namespace Marsrover\Directions;


/**
 * Class DirectionEast
 * @package Marsrover
 */
class DirectionEast implements Idirection
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

    public function name()
    {
        return DirectionEnums::EAST;
    }
}