<?php

namespace Marsrover;

use Marsrover\Directions\Idirection;
use Marsrover\Exceptions\CoordinateOutOfRangeException;
use Marsrover\Exceptions\WorldCannotPlaceObstacleException;
use Marsrover\Exceptions\CannotMoveException;


/**
 * Class Rover
 * @package Marsrover
 */
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

    /**
     * @return World
     */
    public function world()
    {
        return $this->world;
    }

    /**
     *
     */
    public function turnLeft()
    {
        $this->direction = $this->direction->turnLeft();
    }

    /**
     *
     */
    public function turnRight()
    {
        $this->direction = $this->direction->turnRight();
    }

    /**
     * @param Coordinate $coord
     * @throws CannotMoveException
     */
    public function moveTo(Coordinate $coord)
    {
        if (!$this->world->collision($coord)){
            $this->position = $coord;
        } else {
            throw new CannotMoveException();
        }
    }

    /**
     * @return Coordinate
     */
    public function position()
    {
        return $this->position;
    }

    /**
     * @return IDirection
     */
    public function direction()
    {
        return $this->direction;
    }



}