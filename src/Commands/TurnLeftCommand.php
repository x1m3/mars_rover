<?php

namespace Marsrover\Commands;

use Marsrover\Rover;

class TurnLeftCommand
{
    protected $rover;

    public function __construct(Rover $rover)
    {
        $this->rover = $rover;
    }

    public function execute()
    {
        $this->rover->turnLeft();
    }
}