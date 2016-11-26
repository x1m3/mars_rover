<?php

namespace Marsrover\test;

use Marsrover\DirectionNorth;
use PHPUnit\Framework\TestCase;
use Marsrover\Coordinate;
use Marsrover\World;
use Marsrover\Rover;


class RoverTest extends TestCase
{
    /**
     * @expectedException Marsrover\CoordinateOutOfRangeException
     */
    public function testRoverLandingOutOfLimits()
    {
        $this->expectException(
            new Rover(
                new Coordinate(-100,-100),
                new DirectionNorth(),
                new World( new Coordinate(100,100))
            )
        );
    }

    /**
     * @expectedException Marsrover\WorldCannotPlaceObstacleException
     */
    public function testRoverLandingInAnObject()
    {
        $world= new World( new Coordinate(100,100));

        $obstaclePosition =  new Coordinate(40,50);
        $world->addObstacle($obstaclePosition);

        $this->expectException(
            new Rover(
                $obstaclePosition,
                new DirectionNorth(),
                $world
            )
        );
    }


}