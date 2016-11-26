<?php

namespace Marsrover;


class World
{
    private $minCoord;
    private $maxCoord;

    public function __construct(int $x, int $y)
    {
        $this->minCoord = new Coordinate(1, 1);
        $this->maxCoord = new Coordinate($x, $y);
    }

    public function minCoord()
    {
        return $this->minCoord;
    }

    public function maxCoord()
    {
        return $this->maxCoord;
    }

    public function outOfLimits(Coordinate $coord)
    {
        return (
            $coord->coordX()<$this->minCoord()->coordX() ||
            $coord->coordY()<$this->minCoord()->coordY() ||
            $coord->coordX()>$this->maxCoord()->coordX() ||
            $coord->coordY()>$this->maxCoord()->coordY());
    }
}