<?php

namespace Marsrover\Commands;

use Marsrover\Directions\DirectionEnums;
use Marsrover\MovementsEnum;
use Marsrover\Rover;
use Marsrover\Coordinate;

class MoveCommand
{
    protected $rover;
    protected $sense;

    public function __construct(Rover $rover, int $sense)
    {
        $this->rover = $rover;
        $this->sense = $sense;
    }

    public function execute()
    {
        $position = $this->rover->position();
        $world = $this->rover->world();

        if ($this->sense==MovementsEnum::FORWARD) {
            $step = 1;
        } else {
            $step = -1;
        }

        switch ($this->rover->direction()->name()) {
            case DirectionEnums::NORTH:
                $newPosition = new Coordinate($position->coordX(), $position->coordY()-$step);
                if ($world->outOfLimits($newPosition)) {
                    if ($this->sense==MovementsEnum::FORWARD) {
                        $newPosition = new Coordinate($newPosition->coordX(), $world->maxCoord()->coordY());
                    }else {
                        $newPosition = new Coordinate($newPosition->coordX(), $world->minCoord()->coordY());
                    }
                }
                break;
            case DirectionEnums::SOUTH:
                $newPosition = new Coordinate($position->coordX(), $position->coordY()+$step);
                if ($world->outOfLimits($newPosition)) {
                    if ($this->sense==MovementsEnum::FORWARD) {
                        $newPosition = new Coordinate( $newPosition->coordX(), $world->minCoord()->coordY());
                    }else {
                        $newPosition = new Coordinate( $newPosition->coordX(), $world->maxCoord()->coordY());
                    }
                }
                break;
            case DirectionEnums::EAST:
                $newPosition = new Coordinate($position->coordX()+$step, $position->coordY());
                if ($world->outOfLimits($newPosition)) {
                    if ($this->sense==MovementsEnum::FORWARD) {
                        $newPosition = new Coordinate( $world->minCoord()->coordX(), $newPosition->coordY());
                    }else {
                        $newPosition = new Coordinate( $world->maxCoord()->coordX(), $newPosition->coordY());
                    }
                }
                break;
            case DirectionEnums::WEST:
                $newPosition = new Coordinate($position->coordX()-$step, $position->coordY());
                if ($world->outOfLimits($newPosition)) {
                    if ($this->sense==MovementsEnum::FORWARD) {
                        $newPosition = new Coordinate( $world->maxCoord()->coordX(), $newPosition->coordY());
                    }else {
                        $newPosition = new Coordinate( $world->minCoord()->coordX(), $newPosition->coordY());
                    }
                }
                break;
        }
        $this->rover->moveTo($newPosition);
    }
}