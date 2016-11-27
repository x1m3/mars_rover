<?php

namespace Marsrover;

use Marsrover\Commands\MoveCommand;
use Marsrover\Commands\TurnLeftCommand;
use Marsrover\Commands\TurnRightCommand;
use Marsrover\Commands\UnknownCommand;

/**
 * Class CommandParser
 * @package Marsrover\Commands
 */
class CommandParser
{
    /**
     * @var Rover
     */
    private $rover;

    /**
     * CommandParser constructor.
     * @param Rover $rover
     */
    public function __construct(Rover $rover)
    {
        $this->rover = $rover;
    }

    /**
     * @param String $orders
     * @return array
     */
    public function getCommands(String $orders)
    {

        if ($orders=="") {
            return [];
        }
        $ordersList= str_split(strtoupper($orders));

        $commands = [];
        foreach ($ordersList as $order) {
            switch ($order) {
                case 'F':
                    $commands []= new MoveCommand($this->rover, MovementsEnum::FORWARD);
                    break;
                case 'B':
                    $commands []= new MoveCommand($this->rover, MovementsEnum::BACKWARD);
                    break;
                case 'L':
                    $commands []= new TurnLeftCommand($this->rover);
                    break;
                case 'R':
                    $commands []= new TurnRightCommand($this->rover);
                    break;
                default:
                    $commands []= new UnknownCommand();
                    break;
            }
        }
        return $commands;
    }
}