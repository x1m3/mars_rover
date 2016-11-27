<?php
namespace Marsrover\Directions;

interface Idirection {
    public function turnLeft();
    public function turnRight();
    public function name();
}