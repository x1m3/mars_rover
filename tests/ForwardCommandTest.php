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

    public function testForwardCommandMovesOutOfBoundariesNorth() {

        $world= new World( new Coordinate(100,100));
        $initial = new Coordinate($world->minCoord()->coordX(), $world->minCoord()->coordY());
        $rover = new Rover($initial, new DirectionNorth(), $world);

        $moveForward = new ForwardCommand($rover);
        $moveForward->execute();

        $this->assertEquals($world->minCoord()->coordX(), $rover->Position()->coordX());
        $this->assertEquals($world->maxCoord()->coordY(), $rover->Position()->coordY());
    }

    public function testForwardCommandMovesOutOfBoundariesSouth() {

        $world= new World( new Coordinate(100,100));
        $initial = new Coordinate($world->minCoord()->coordX(), $world->maxCoord()->coordY());
        $rover = new Rover($initial, new DirectionSouth(), $world);

        $moveForward = new ForwardCommand($rover);
        $moveForward->execute();

        $this->assertEquals($world->minCoord()->coordX(), $rover->Position()->coordX());
        $this->assertEquals($world->minCoord()->coordY(), $rover->Position()->coordY());
    }

    public function testForwardCommandMovesOutOfBoundariesWest() {

        $world= new World( new Coordinate(100,100));
        $initial = new Coordinate($world->minCoord()->coordX(), $world->minCoord()->coordY());
        $rover = new Rover($initial, new DirectionWest(), $world);

        $moveForward = new ForwardCommand($rover);
        $moveForward->execute();

        $this->assertEquals($world->maxCoord()->coordX(), $rover->Position()->coordX());
        $this->assertEquals($world->minCoord()->coordY(), $rover->Position()->coordY());
    }

    public function testForwardCommandMovesOutOfBoundariesEast() {

        $world= new World( new Coordinate(100,100));
        $initial = new Coordinate($world->maxCoord()->coordX(), $world->minCoord()->coordY());
        $rover = new Rover($initial, new DirectionEast(), $world);

        $moveForward = new ForwardCommand($rover);
        $moveForward->execute();

        $this->assertEquals($world->minCoord()->coordX(), $rover->Position()->coordX());
        $this->assertEquals($world->minCoord()->coordY(), $rover->Position()->coordY());
    }
}