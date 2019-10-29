<?php

namespace Lunkkun\Rectangles\Tests;

use Lunkkun\Rectangles\RectangleCounter;
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

        $rc = new RectangleCounter($ascii);
        $this->assertEquals(1, $rc->count());
    }

    public function testCountsRectanglesComplex()
    {
        $ascii = <<<EOL
        -+-++
         +-+++-+|+
        ||  |  | |
         +--+--+-+
        EOL;

        $rc = new RectangleCounter($ascii);
        $this->assertEquals(7, $rc->count());
    }
}
