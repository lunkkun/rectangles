<?php

namespace Lunkkun\Rectangles;

class Rectangle
{
    public $topLeft;
    public $bottomRight;
    /** @var string[] */
    public $lines;

    function __construct(Point $topLeft, Point $bottomRight, array &$lines)
    {
        $this->topLeft = $topLeft;
        $this->bottomRight = $bottomRight;
        $this->lines = &$lines;
    }

    function __toString()
    {
        $string = "";

        for ($i = $this->topLeft->i; $i <= $this->bottomRight->i; $i++) {
            for ($j = $this->topLeft->j; $j <= $this->bottomRight->j; $j++) {
                $string .= $this->lines[$i][$j];
            }
            $string .= PHP_EOL;
        }

        return $string;
    }
}
