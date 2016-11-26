<?php

namespace Marsrover\test;

use PHPUnit\Framework\TestCase;
use Marsrover\Coordinate;

class AutoloaderWorksTest extends TestCase
{
    public function testAutoloaderWorks()
    {
        $coord = new Coordinate(5,5);
        $this->assertInstanceOf(Coordinate::class , $coord );
    }
}