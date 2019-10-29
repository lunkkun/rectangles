<?php

namespace Lunkkun\Rectangles\Tests;

use Lunkkun\Rectangles\SquareFinder;
use PHPUnit\Framework\TestCase;

class SquareFinderTest extends TestCase
{
    public function testFindsSquaresSimple()
    {
        $ascii = <<<EOL
        +-+
        | |
        +-+
        EOL;

        $finder = new SquareFinder($ascii);
        $this->assertEquals(1, count($finder->find()));
    }

    public function testFindsSquaresIntertwined()
    {
        $ascii = <<<EOL
        +---+
        |   |
        | +-+-+
        | | | |
        +-+-+ |
          |   |
          +---+
        EOL;

        $finder = new SquareFinder($ascii);
        $this->assertEquals(3, count($finder->find()));
    }

    public function testFindsSquaresNested()
    {
        $ascii = <<<EOL
        +-+-+
        | | |
        +-+-+
        | | |
        +-+-+
        EOL;

        $finder = new SquareFinder($ascii);
        $this->assertEquals(5, count($finder->find()));
    }

    public function testFindsSquaresComplex()
    {
        $ascii = <<<EOL
        -+-++
         +-+++-+|+
        ||  |  | |
         +--+--+-+
        EOL;

        $finder = new SquareFinder($ascii);
        $this->assertEquals(2, count($finder->find()));
    }
}
