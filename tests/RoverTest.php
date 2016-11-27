<?php

namespace Marsrover\test;

use Marsrover\DirectionNorth;
use Marsrover\DirectionSouth;
use Marsrover\DirectionEast;
use Marsrover\DirectionWest;
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

    public function testLandingPositionIsOk()
    {
        $rover = new Rover(
            new Coordinate(40,50),
            new DirectionNorth(),
            new World( new Coordinate(100,100))
        );
        $this->assertEquals(40, $rover->Position()->coordX());
        $this->assertEquals(50, $rover->Position()->coordY());
    }

    public function testDirectionPositionIsOk()
    {
        $rover = new Rover(
            new Coordinate(40,50),
            new DirectionNorth(),
            new World( new Coordinate(100,100))
        );
        $this->assertInstanceOf(DirectionNorth::class, $rover->Direction());
    }

    public function testRoverTurnsLeft()
    {
        $rover = new Rover(
            new Coordinate(40,50),
            new DirectionNorth(),
            new World( new Coordinate(100,100))
        );

        $rover->turnLeft();
        $this->assertInstanceOf(DirectionWest::class, $rover->Direction());

        $rover->turnLeft();
        $this->assertInstanceOf(DirectionSouth::class, $rover->Direction());

        $rover->turnLeft();
        $this->assertInstanceOf(DirectionEast::class, $rover->Direction());

        $rover->turnLeft();
        $this->assertInstanceOf(DirectionNorth::class, $rover->Direction());
    }

    public function testRoverTurnsRight()
    {
        $rover = new Rover(
            new Coordinate(40,50),
            new DirectionNorth(),
            new World( new Coordinate(100,100))
        );

        $rover->turnRight();
        $this->assertInstanceOf(DirectionEast::class, $rover->Direction());

        $rover->turnRight();
        $this->assertInstanceOf(DirectionSouth::class, $rover->Direction());

        $rover->turnRight();
        $this->assertInstanceOf(DirectionWest::class, $rover->Direction());

        $rover->turnRight();
        $this->assertInstanceOf(DirectionNorth::class, $rover->Direction());
    }

    /**
     * @expectedException Marsrover\CannotMoveException
     */
    public function testRoversMovesToObstacle()
    {
        $world= new World( new Coordinate(100,100));
        $obstaclePosition =  new Coordinate(40,50);
        $world->addObstacle($obstaclePosition);
        $roverPosition = new Coordinate($obstaclePosition->coordX(), $obstaclePosition->coordX()-1);

        $rover = new Rover(
                $roverPosition,
                new DirectionNorth(),
                $world
        );
        $this->expectException($rover->moveTo($obstaclePosition));
    }
}