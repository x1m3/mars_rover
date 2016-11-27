<?php

namespace Marsrover\test;

use Marsrover\Commands\MoveCommand;
use Marsrover\MovementsEnum;
use PHPUnit\Framework\TestCase;
use Marsrover\Rover;
use Marsrover\Coordinate;
use Marsrover\World;
use Marsrover\Directions\IDirection;
use Marsrover\Directions\DirectionNorth;
use Marsrover\Directions\DirectionSouth;
use Marsrover\Directions\DirectionEast;
use Marsrover\Directions\DirectionWest;


class ForwardCommandTest extends TestCase
{
    public function getRoversToTestMovement()
    {
        $world= new World( new Coordinate(100,100));

        return [
            [ //Move forward to North, not in boundary
                $world,
                new Coordinate(10,20),
                new DirectionNorth(),
                MovementsEnum::FORWARD,
                new Coordinate(10,19)
            ],
            [ //Move forward to South, not in boundary
                $world,
                new Coordinate(10,20),
                new DirectionSouth(),
                MovementsEnum::FORWARD,
                new Coordinate(10,21)
            ],
            [ //Move forward to West, not in boundary
                $world,
                new Coordinate(10,20),
                new DirectionWest(),
                MovementsEnum::FORWARD,
                new Coordinate(9,20)
            ],
            [ //Move forward to East, not in boundary
                $world,
                new Coordinate(10,20),
                new DirectionEast(),
                MovementsEnum::FORWARD,
                new Coordinate(11,20)
            ],
            [ //Move forward to North out of boundaries
                $world,
                new Coordinate(1,1),
                new DirectionNorth(),
                MovementsEnum::FORWARD,
                new Coordinate(1,100)
            ],
            [ //Move forward to south out of boundaries
                $world,
                new Coordinate(1,100),
                new DirectionSouth(),
                MovementsEnum::FORWARD,
                new Coordinate(1,1)
            ],

            [ //Move forward to west out of boundaries
                $world,
                new Coordinate(1,1),
                new DirectionWest(),
                MovementsEnum::FORWARD,
                new Coordinate(100,1)
            ],
            [ //Move forward to east out of boundaries
                $world,
                new Coordinate(100,1),
                new DirectionEast(),
                MovementsEnum::FORWARD,
                new Coordinate(1,1)
            ],
            [ //Move backward to North, not in boundary
                $world,
                new Coordinate(10,20),
                new DirectionNorth(),
                MovementsEnum::BACKWARD,
                new Coordinate(10,21)
            ],
            [ //Move backward to South, not in boundary
                $world,
                new Coordinate(10,20),
                new DirectionSouth(),
                MovementsEnum::BACKWARD,
                new Coordinate(10,19)
            ],
            [ //Move backward to West, not in boundary
                $world,
                new Coordinate(10,20),
                new DirectionWest(),
                MovementsEnum::BACKWARD,
                new Coordinate(11,20)
            ],
            [ //Move backward to East, not in boundary
                $world,
                new Coordinate(10,20),
                new DirectionEast(),
                MovementsEnum::BACKWARD,
                new Coordinate(9,20)
            ],

            [ //Move backward to North out of boundaries
                $world,
                new Coordinate(1,100),
                new DirectionNorth(),
                MovementsEnum::BACKWARD,
                new Coordinate(1,1)
            ],
            [ //Move backward to south out of boundaries
                $world,
                new Coordinate(1,1),
                new DirectionSouth(),
                MovementsEnum::BACKWARD,
                new Coordinate(1,100)
            ],
            [ //Move backward to west out of boundaries
                $world,
                new Coordinate(100,1),
                new DirectionWest(),
                MovementsEnum::BACKWARD,
                new Coordinate(1,1)
            ],
            [ //Move backward to east out of boundaries
                $world,
                new Coordinate(1,1),
                new DirectionEast(),
                MovementsEnum::BACKWARD,
                new Coordinate(100,1)
            ]
        ];
    }


    /**
     * @dataProvider getRoversToTestMovement
     * @param Coordinate $expected
     * @param Rover $rover
     * @param int $sense
     */
    public function testMoveForwardAndBackward(World $world, Coordinate $start, IDirection $direction, int $sense, Coordinate $expected)
    {
        $rover = new Rover($start, $direction, $world);

        $move= new MoveCommand($rover, $sense);
        $move->execute();

        $this->assertEquals($expected->coordX(), $rover->Position()->coordX());
        $this->assertEquals($expected->coordY(), $rover->Position()->coordY());
    }
}