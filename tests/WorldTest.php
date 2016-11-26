<?php

namespace Marsrover\test;


use Marsrover\Coordinate;
use PHPUnit\Framework\TestCase;
use Marsrover\World;


class WorldTest extends TestCase
{
    public function testDimensions()
    {
        $world = new World(new Coordinate(10,20));

        $minBoundary = $world->minCoord();
        $this->assertInstanceOf(Coordinate::class, $minBoundary);
        $this->assertEquals(1, $minBoundary->coordX());
        $this->assertEquals(1, $minBoundary->coordY());

        $maxBoundary = $world->maxCoord();
        $this->assertInstanceOf(Coordinate::class, $maxBoundary);
        $this->assertEquals(10, $maxBoundary->coordX());
        $this->assertEquals(20, $maxBoundary->coordY());
    }


    public function pointsInAndOutBoundariesProvider()
    {
        return [
            // Points inside World
            [false, new Coordinate(1,1)],
            [false, new Coordinate(1,20)],
            [false, new Coordinate(10,20)],
            [false, new Coordinate(10,1)],
            [false, new Coordinate(5,5)],

            //Points outside World
            [true, new Coordinate(0,0)],
            [true, new Coordinate(11,21)],
            [true, new Coordinate(0,1)],
            [true, new Coordinate(1,0)],
            [true, new Coordinate(1,21)],
            [true, new Coordinate(0,20)],
            [true, new Coordinate(11,20)],
            [true, new Coordinate(10,22)],
            [true, new Coordinate(11,1)],
            [true, new Coordinate(10,0)],
            [true, new Coordinate(-100,5)],
            [true, new Coordinate(100,5)],
            [true, new Coordinate(5,-100)],
            [true, new Coordinate(5,100)]
        ];
    }

    /**
     * @dataProvider pointsInAndOutBoundariesProvider
     */
    public function testBoundaries(bool $outOfBoundary, Coordinate $coord)
    {
        $world = new World(new Coordinate(10,20));
        $this->assertEquals($outOfBoundary, $world->outOfLimits($coord));
    }
    /**
     * @expectedException Marsrover\CoordinateOutOfRangeException
     */
    public function testAddingObstacleOutOfBoundaries()
    {
        $world = new World(new Coordinate(10,20));
        $this->expectException($world->addObstacle(new Coordinate(100,100)));
    }

    public function testObstacleGeneratesCollision()
    {
        $world = new World(new Coordinate(10,20));

        $world->addObstacle(new Coordinate(5,5));
        $world->addObstacle(new Coordinate(5,6));
        $world->addObstacle(new Coordinate(5,7));
        $world->addObstacle(new Coordinate(5,8));

        $this->assertEquals(false,$world->collision(new Coordinate(4,6)));
        $this->assertEquals(true,$world->collision(new Coordinate(5,6)));
        $this->assertEquals(false,$world->collision(new Coordinate(6,6)));
        $this->assertEquals(false,$world->collision(new Coordinate(7,6)));
    }
    /**
     * @expectedException Marsrover\WorldCannotPlaceObstacleException
     */
    public function testCannotPlaceTwoObstaclesSamePlace()
    {
        $world = new World(new Coordinate(10,20));
        $world->addObstacle(new Coordinate(5,5));
        $this->expectException($world->addObstacle(new Coordinate(5,5)));
    }
}
