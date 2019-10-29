<?php

namespace Lunkkun\Rectangles\Tests;

use Lunkkun\Rectangles\RectangleFinder;
use PHPUnit\Framework\TestCase;

class RectangleFinderTest extends TestCase
{
    public function testFindsRectanglesSimple()
    {
        $ascii = <<<EOL
        +-+
        | |
        +-+
        EOL;

        $finder = new RectangleFinder($ascii);
        $this->assertEquals(1, count($finder->find()));
    }

    public function testFindsRectanglesComplex()
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
