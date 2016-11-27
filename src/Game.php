<?php


namespace Marsrover;

use Marsrover\Directions\DirectionNorth;
use Marsrover\Directions\Idirection;


class Game
{
    private $rover;

    public function __construct(
        Coordinate $worldSize=NULL,
        Coordinate $initialPosition=NULL,
        IDirection $direction=NULL,
        array $obstacles=[])
    {
        if (!isset($worlSize)) {
            $worldSize = new Coordinate(10, 10);
        }
        if (!isset($initialPosition)) {
            $initialPosition= new Coordinate(1,1);
        }
        if (!isset($direction)) {
            $direction = new DirectionNorth();
        }
        $world = new World($worldSize);
        foreach ($obstacles as $obstacle) {
            $world->addObstacle($obstacle);
        }
        $this->rover = new Rover($initialPosition, $direction, $world);
    }

    public function run(string $commands)
    {
        $parser = new CommandParser($this->rover);
        $commands = $parser->getCommands($commands);
        foreach ($commands as $command) {
            $command->execute();
            echo $this->coordToString($this->rover->position());
        }
    }

    public function rover() {
        return $this->rover;
    }

    private function coordToString(Coordinate $coordinate)
    {
        return "[" . $coordinate->coordX() . ", " . $coordinate->coordY() . "]";
    }
}
