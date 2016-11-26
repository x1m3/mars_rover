<?php

namespace Marsrover;


class Rover
{
    /**
     * @var Coordinate
     */
    private $position;
    /**
     * @var IDirection
     */
    private $direction;
    /**
     * @var World
     */
    private $world;

    /**
     * Rover constructor.
     * @param Coordinate $initialPosition
     * @param IDirection $direction
     * @param World $world
     * @throws CoordinateOutOfRangeException
     * @throws WorldCannotPlaceObstacleException
     */
    public function __construct(Coordinate $initialPosition, IDirection $direction, World $world)
    {
        if ($world->collision($initialPosition)) {
            throw new WorldCannotPlaceObstacleException();
        }
        if ($world->outOfLimits($initialPosition)) {
            throw new CoordinateOutOfRangeException();
        }
        $this->position = $initialPosition;
        $this->direction = $direction;
        $this->world = $world;
    }
}