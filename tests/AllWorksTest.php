<?php


namespace Marsrover\test;

use PHPUnit\Framework\TestCase;
use Marsrover\Coordinate;
use Marsrover\Game;
use Marsrover\Directions\DirectionEast;


/**
 * Class AllWorksTest
 * @package Marsrover\test
 *
 * This is not exactly a test. It is the entry point for this exercise. It runs the Example class as a
 * way of testing that all works, the rover moves, etc...
 */

class AllWorksTest extends TestCase
{

    private $example;

    public function setUp()
    {
        $this->example = new Game(
            new Coordinate(10, 10),
            new Coordinate(1, 1)
            , new DirectionEast(),
            [
                new Coordinate(3, 3),
                new Coordinate(3, 6),
                new Coordinate(6, 7),
                new Coordinate(5, 5)
            ]
        );
    }

    /**
     * @expectedException Marsrover\Exceptions\CannotMoveException
     */
    public function testRoverCrashesIn3_3()
    {
        echo "\r\n\nTesting crash in [3,3]\r\n";
        $this->expectException($this->example->run("FRFLFRFLFRFLFRFLFRFLFRFLFRFLFRFLFRFL"));
    }

    public function testRoverGoesTo_10_10_LongWay()
    {
        echo "\r\n\nTesting [1,1]-[10-10] Long Way\r\n";
        $expected = new Coordinate(10,10);
        $this->example->run("FFFFFFFFFRFFFFFFFFF");
        $this->assertEquals($expected, $this->example->rover()->position());
    }

    public function testRoverGoesTo_10_10_ShortWay()
    {
        echo "\r\n\nTesting [1,1]-[10-10] Short Way\r\n";
        $expected = new Coordinate(10,10);
        $this->example->run("LFLF");
        //$this->assertEquals()
    }


}