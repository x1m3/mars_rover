<?php

namespace Marsrover\test;

use Marsrover\DirectionEnums;
use PHPUnit\Framework\TestCase;
use Marsrover\DirectionNorth;
use Marsrover\DirectionSouth;
use Marsrover\DirectionEast;
use Marsrover\DirectionWest;


class DirectionTest extends TestCase
{
    public function testDirectionNorthTurnLeft()
    {
        $direction = new DirectionNorth();
        $this->assertInstanceOf(DirectionWest::class, $direction->turnLeft());
    }

    public function testDirectionWestTurnLeft()
    {
        $direction = new DirectionWest();
        $this->assertInstanceOf(DirectionSouth::class, $direction->turnLeft());
    }

    public function testDirectionSouthTurnLeft()
    {
        $direction = new DirectionSouth();
        $this->assertInstanceOf(DirectionEast::class, $direction->turnLeft());
    }

    public function testDirectionEastTurnLeft()
    {
        $direction = new DirectionEast();
        $this->assertInstanceOf(DirectionNorth::class, $direction->turnLeft());
    }

    public function testDirectionNorthTurnRight()
    {
        $direction = new DirectionNorth();
        $this->assertInstanceOf(DirectionEast::class, $direction->turnRight());
    }

    public function testDirectionWestTurnRight()
    {
        $direction = new DirectionWest();
        $this->assertInstanceOf(DirectionNorth::class, $direction->turnRight());
    }

    public function testDirectionSouthTurnRight()
    {
        $direction = new DirectionSouth();
        $this->assertInstanceOf(DirectionWest::class, $direction->turnRight());
    }

    public function testDirectionEastTurnRight()
    {
        $direction = new DirectionEast();
        $this->assertInstanceOf(DirectionSouth::class, $direction->turnRight());
    }

    public function testDirectionNames()
    {
        $direction = new DirectionNorth();
        $this->assertEquals(DirectionEnums::NORTH, $direction->name());

        $direction = new DirectionSouth();
        $this->assertEquals(DirectionEnums::SOUTH, $direction->name());

        $direction = new DirectionEast();
        $this->assertEquals(DirectionEnums::EAST, $direction->name());

        $direction = new DirectionWest();
        $this->assertEquals(DirectionEnums::WEST, $direction->name());
    }

}