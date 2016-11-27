<?php

namespace Marsrover;


/**
 * Class Coordinate
 * @package Marsrover
 */
class Coordinate
{
    /**
     * @var int
     */
    private $x;
    /**
     * @var int
     */
    private $y;

    /**
     * Coordinate constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function coordX()
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function coordY()
    {
        return $this->y;
    }
}