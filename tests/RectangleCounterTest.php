<?php

namespace Lunkkun\Rectangles\Tests;

use Lunkkun\Rectangles\RectangleFinder;
use PHPUnit\Framework\TestCase;

class RectangleCounterTest extends TestCase
{
    public function testCountsRectanglesSimple()
    {
        $ascii = <<<EOL
        +-+
        | |
        +-+
        EOL;

        $finder = new RectangleFinder($ascii);
        $this->assertEquals(1, count($finder->find()));
    }

    public function testCountsRectanglesComplex()
    {
        $ascii = <<<EOL
        -+-++
         +-+++-+|+
        ||  |  | |
         +--+--+-+
        EOL;

        $finder = new RectangleFinder($ascii);
        $this->assertEquals(7, count($finder->find()));
    }
}
