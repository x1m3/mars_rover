<?php

namespace Marsrover;


class Coordinate
{
    private $x;
    private $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function coordX()
    {
        return $this->x;
    }

    public function coordY()
    {
        return $this->y;
    }
}