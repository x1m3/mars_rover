<?php

namespace Marsrover;
use Marsrover\Directions\DirectionEast;

require "../vendor/autoload.php";

$example = new Game(
    new Coordinate(10, 10),
    new Coordinate(1, 1),
    new DirectionEast(),
    [
        new Coordinate(3, 3),
        new Coordinate(3, 6),
        new Coordinate(6, 7),
        new Coordinate(5, 5)
    ]
);
try {
    $example->run("FFRFFRFFR");
}
catch (\Exception $e) {
    echo "[Found an obstacle]";
}
