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
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->minCoord = new Coordinate(1, 1);
        $this->maxCoord = new Coordinate($x, $y);
        $this->obstacles = [];
    }

    /**
     * @param int $x
     * @param int $y
     * @throws CoordinateOutOfRangeException
     * @throws WorldCannotPlaceObstacleException
     */
    public function addObstacle(int $x, int $y)
    {
        $coord = new Coordinate($x, $y);
        if ($this->outOfLimits($coord)){
            throw new CoordinateOutOfRangeException();
        }
        if ($this->collision($coord)) {
            throw new WorldCannotPlaceObstacleException();
        }
        $this->obstacles []= $coord;
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