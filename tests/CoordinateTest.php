<?php

namespace Marsrover\test;

use PHPUnit\Framework\TestCase;
use Marsrover\Coordinate;

class CoordinateTest extends TestCase
{
    public function testCorrectValuesInCoordinates()
    {
        $coord = new Coordinate(1,2);
        $this->assertEquals(1, $coord->coordX());
        $this->assertEquals(2, $coord->coordY());
    }
}