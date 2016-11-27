<?php

namespace Marsrover\Commands;

use Marsrover\Directions\DirectionEnums;
use Marsrover\Rover;
use Marsrover\Coordinate;

class ForwardCommand
{
    protected $rover;

    public function __construct(Rover $rover)
    {
        $this->rover = $rover;
    }

    public function execute()
    {
        $position = $this->rover->Position();
        $world = $this->rover->world();

        switch ($this->rover->Direction()->name()) {
            case DirectionEnums::NORTH:
                $newPosition = new Coordinate($position->coordX(), $position->coordY()-1);
                if ($world->outOfLimits($newPosition)) {
                    $newPosition = new Coordinate( $newPosition->coordX(), $world->maxCoord()->coordY());
                }
                break;
            case DirectionEnums::SOUTH:
                $newPosition = new Coordinate($position->coordX(), $position->coordY()+1);
                if ($world->outOfLimits($newPosition)) {
                    $newPosition = new Coordinate( $newPosition->coordX(), $world->minCoord()->coordY());
                }
                break;
            case DirectionEnums::EAST:
                $newPosition = new Coordinate($position->coordX()+1, $position->coordY());
                if ($world->outOfLimits($newPosition)) {
                    $newPosition = new Coordinate( $world->minCoord()->coordX(), $newPosition->coordY());
                }
                break;
            case DirectionEnums::WEST:
                $newPosition = new Coordinate($position->coordX()-1, $position->coordY());
                if ($world->outOfLimits($newPosition)) {
                    $newPosition = new Coordinate( $world->maxCoord()->coordX(), $newPosition->coordY());
                }
                break;
        }
        $this->rover->moveTo($newPosition);
    }
}