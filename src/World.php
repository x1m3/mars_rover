<?php

namespace Marsrover;


/**
 * Class World
 * @package Marsrover
 */
/**
 * Class World
 * @package Marsrover
 */
/**
 * Class World
 * @package Marsrover
 */
class World
{
    /**
     * @var Coordinate
     */
    private $minCoord;
    /**
     * @var Coordinate
     */
    private $maxCoord;
    /**
     * @var array
     */
    private $obstacles;

    /**
     * World constructor.
     * @param Coordinate $maxDimensions
     */
    public function __construct(Coordinate $maxDimensions)
    {
        $this->minCoord = new Coordinate(1, 1);
        $this->maxCoord = $maxDimensions;
        $this->obstacles = [];
    }

    /**
     * @param Coordinate $obstacle
     * @throws CoordinateOutOfRangeException
     * @throws WorldCannotPlaceObstacleException
     */
    public function addObstacle(Coordinate $obstacle)
    {
        if ($this->outOfLimits($obstacle)){
            throw new CoordinateOutOfRangeException();
        }
        if ($this->collision($obstacle)) {
            throw new WorldCannotPlaceObstacleException();
        }
        $this->obstacles []= $obstacle;
    }

    /**
     * @return Coordinate
     */
    public function minCoord()
    {
        return $this->minCoord;
    }

    /**
     * @return Coordinate
     */
    public function maxCoord()
    {
        return $this->maxCoord;
    }

    /**
     * @param Coordinate $coord
     * @return bool
     */
    public function outOfLimits(Coordinate $coord)
    {
        return (
            $coord->coordX()<$this->minCoord()->coordX() ||
            $coord->coordY()<$this->minCoord()->coordY() ||
            $coord->coordX()>$this->maxCoord()->coordX() ||
            $coord->coordY()>$this->maxCoord()->coordY());
    }

    /**
     * @param Coordinate $coord
     * @return bool
     */
    public function collision(Coordinate $coord)
    {
        foreach($this->obstacles as $obstacle) {
            if (
                $obstacle->coordX()==$coord->coordX() &&
                $obstacle->coordY()==$coord->coordY()
            ) {
                return true;
            }
        }
        return false;
    }
}