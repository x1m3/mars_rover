<?php

namespace Marsrover\test;

use Marsrover\Commands\TurnLeftCommand;
use PHPUnit\Framework\TestCase;
use Marsrover\Rover;
use Marsrover\Coordinate;
use Marsrover\World;
use Marsrover\Directions\DirectionNorth;
use Marsrover\Directions\DirectionSouth;
use Marsrover\Directions\DirectionEast;
use Marsrover\Directions\DirectionWest;

class TurnLeftCommandTest  extends TestCase
{
    public function testRoversTurnLeft()
    {
        $rover = new Rover(
            new Coordinate(40,50),
            new DirectionNorth(),
            new World( new Coordinate(100,100))
        );
        $turnLeft = new TurnLeftCommand($rover);

        $turnLeft->execute();
        $this->assertInstanceOf(DirectionWest::class, $rover->Direction());

        $turnLeft->execute();
        $this->assertInstanceOf(DirectionSouth::class, $rover->Direction());

        $turnLeft->execute();
        $this->assertInstanceOf(DirectionEast::class, $rover->Direction());

        $turnLeft->execute();
        $this->assertInstanceOf(DirectionNorth::class, $rover->Direction());
    }
}