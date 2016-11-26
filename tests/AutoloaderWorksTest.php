<?php

namespace Marsrover\test;

use PHPUnit\Framework\TestCase;
use Marsrover;

class AutoloaderWorksTest extends TestCase
{
    public function testAutoloaderWorks()
    {
        $coord = new Marsrover\Coordinate(5,5);
        $this->assertInstanceOf(Marsrover\Coordinate::class , $coord );
    }

}