<?php

namespace Marsrover\test;

use Marsrover\Commands\TurnRightCommand;
use PHPUnit\Framework\TestCase;
use Marsrover\Rover;
use Marsrover\Coordinate;
use Marsrover\World;
use Marsrover\Directions\DirectionNorth;
use Marsrover\Directions\DirectionSouth;
use Marsrover\Directions\DirectionEast;
use Marsrover\Directions\DirectionWest;

class TurnRightCommandTest  extends TestCase
{
    public function testRoversTurnsRight()
    {
        $rover = new Rover(
            new Coordinate(40,50),
            new DirectionNorth(),
            new World( new Coordinate(100,100))
        );
        $turnLeft = new TurnRightCommand($rover);

        $turnLeft->execute();
        $this->assertInstanceOf(DirectionWest::class, $rover->direction());

        $turnLeft->execute();
        $this->assertInstanceOf(DirectionSouth::class, $rover->direction());

        $turnLeft->execute();
        $this->assertInstanceOf(DirectionEast::class, $rover->direction());

        $turnLeft->execute();
        $this->assertInstanceOf(DirectionNorth::class, $rover->direction());
    }
}