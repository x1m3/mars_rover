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
        $worldSizeX = $world->maxCoord()->coordX() - $world->minCoord()->coordX();
        $worldSizeY = $world->maxCoord()->coordY() - $world->minCoord()->coordY();

        switch ($this->rover->Direction()->name()) {
            case DirectionEnums::NORTH:
                $newPosition = new Coordinate($position->coordX(), $position->coordY()-1);
                if ($world->outOfLimits($newPosition)) {
                    $newPosition = new Coordinate( $newPosition->coordX(), $newPosition->coordY() - $worldSizeY);
                }
                break;
            case DirectionEnums::SOUTH:
                $newPosition = new Coordinate($position->coordX(), $position->coordY()+1);
                if ($world->outOfLimits($newPosition)) {
                    $newPosition = new Coordinate( $newPosition->coordX(), $newPosition->coordY() + $worldSizeY);
                }
                break;
            case DirectionEnums::EAST:
                $newPosition = new Coordinate($position->coordX()+1, $position->coordY());
                if ($world->outOfLimits($newPosition)) {
                    $newPosition = new Coordinate( $newPosition->coordX() - $worldSizeX, $newPosition->coordY());
                }
                break;
            case DirectionEnums::WEST:
                $newPosition = new Coordinate($position->coordX()-1, $position->coordY());
                if ($world->outOfLimits($newPosition)) {
                    $newPosition = new Coordinate( $newPosition->coordX() + $worldSizeX, $newPosition->coordY());
                }
                break;
        }
        $this->rover->moveTo($newPosition);
    }
}