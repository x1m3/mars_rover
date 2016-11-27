<?php

namespace Marsrover\test;

use Marsrover\CommandParser;
use Marsrover\MovementsEnum;
use PHPUnit\Framework\TestCase;
use Marsrover\Rover;
use Marsrover\Coordinate;
use Marsrover\World;
use Marsrover\Directions\DirectionNorth;
use Marsrover\Commands\MoveCommand;
use Marsrover\Commands\UnknownCommand;
use Marsrover\Commands\TurnLeftCommand;
use Marsrover\Commands\TurnRightCommand;


class CommandParserTest extends TestCase
{
    private $rover;
    private $parser;

    public function setUp()
    {
        $this->rover = new Rover(
            new Coordinate(40,50),
            new DirectionNorth(),
            new World( new Coordinate(100,100))
        );

        $this->parser = new CommandParser($this->rover);
    }
    public function testUnknownCommand()
    {
        $commands = $this->parser->getCommands("qwsasdxcvntuiopñ1234567890");
        foreach ($commands as $command) {
            $this->assertInstanceOf(UnknownCommand::class, $command);
        }
    }

    public function testEmptyCommandList()
    {
        $commands = $this->parser->getCommands("");
        $this->assertCount(0,$commands);
    }

    public function testCountCommandList()
    {
        $commands = $this->parser->getCommands("LFFRBB");
        $this->assertCount(6,$commands);
    }
}