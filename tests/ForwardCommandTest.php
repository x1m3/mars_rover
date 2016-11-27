<?php

namespace Marsrover\test;

use Marsrover\Commands\ForwardCommand;
use PHPUnit\Framework\TestCase;
use Marsrover\Rover;
use Marsrover\Coordinate;
use Marsrover\World;
use Marsrover\Directions\DirectionNorth;
use Marsrover\Directions\DirectionSouth;
use Marsrover\Directions\DirectionEast;
use Marsrover\Directions\DirectionWest;


class ForwardCommandTest extends TestCase
{
    protected $roverNorth;
    protected $roverSouth;
    protected $roverEast;
    protected $roverWest;

    public function setUp()
    {
        $world= new World( new Coordinate(100,100));
        $initial = new Coordinate(40,50);

        $this->roverNorth = new Rover($initial, new DirectionNorth(), $world);
        $this->roverSouth = new Rover($initial, new DirectionSouth(), $world);
        $this->roverEast = new Rover($initial, new DirectionEast(), $world);
        $this->roverWest = new Rover($initial, new DirectionWest(), $world);
    }

    public function testForwardCommandMovesRoverToNorth()
    {
        $rover = $this->roverNorth;

        $moveForward = new ForwardCommand($rover);
        $moveForward->execute();
        $this->assertEquals(40,$rover->Position()->coordX());
        $this->assertEquals(49,$rover->Position()->coordY());
    }

    public function testForwardCommandMovesRoverToSouth()
    {
        $rover = $this->roverSouth;

        $moveForward = new ForwardCommand($rover);
        $moveForward->execute();
        $this->assertEquals(40,$rover->Position()->coordX());
        $this->assertEquals(51,$rover->Position()->coordY());
    }

    public function testForwardCommandMovesRoverToWest()
    {
        $rover = $this->roverWest;

        $moveForward = new ForwardCommand($rover);
        $moveForward->execute();
        $this->assertEquals(39,$rover->Position()->coordX());
        $this->assertEquals(50,$rover->Position()->coordY());
    }

    public function testForwardCommandMovesRoverToEast()
    {
        $rover = $this->roverEast;

        $moveForward = new ForwardCommand($rover);
        $moveForward->execute();
        $this->assertEquals(41,$rover->Position()->coordX());
        $this->assertEquals(50,$rover->Position()->coordY());
    }





}