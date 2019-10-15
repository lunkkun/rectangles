<?php

require_once("Point.php");

class RectangleCounter
{
    public $count;
    public $lines;

    function __construct(string $ascii)
    {
        $this->lines = explode(PHP_EOL, $ascii);
    }

    function count() : int
    {
        $point = new Point(0, -1);
        while ($point = $this->findNextPlus($point)) {
            $this->findRectangles($point);
        }

        return $this->count;
    }

    function findNextPlus(Point $point) : ?Point
    {
        for ($i = $point->i; $i < count($this->lines); $i++) {
            $jStart = $i === $point->i ? $point->j + 1 : 0;
            for ($j = $jStart; $j < strlen($this->lines[$i]); $j++) {
                if ($this->lines[$i][$j] === '+') {
                    return new Point($i, $j);
                }
            }
        }

        return null;
    }

    function findRectangles(Point $topLeft)
    {
        $possibleBottomRights = [];

        $topRight = $topLeft;
        while ($topRight = $this->findNextCornerHorizontal($topRight)) {
            $bottomRight = $topRight;
            while ($bottomRight = $this->findNextCornerVertical($bottomRight)) {
                $possibleBottomRights[] = $bottomRight;
            }
        }

        $bottomLeft = $topLeft;
        while ($bottomLeft = $this->findNextCornerVertical($bottomLeft)) {
            $bottomRight = $bottomLeft;
            while ($bottomRight = $this->findNextCornerHorizontal($bottomRight)) {
                if (in_array($bottomRight, $possibleBottomRights)) {
                    echo "Found one: $topLeft - $bottomRight" . PHP_EOL;
                    $this->count++;
                }
            }
        }
    }

    function findNextCornerHorizontal(Point $point) : ?Point
    {
        $i = $point->i;
        for ($j = $point->j + 1; $j < strlen($this->lines[$i]); $j++) {
            if ($this->lines[$i][$j] === '+') {
                return new Point($i, $j);
            } elseif ($this->lines[$i][$j] !== '-') {
                break;
            }
        }

        return null;
    }

    function findNextCornerVertical(Point $point) : ?Point
    {
        $j = $point->j;
        for ($i = $point->i + 1; $i < count($this->lines); $i++) {
            if (strlen($this->lines[$i]) <= $j) {
                break;
            } elseif ($this->lines[$i][$j] === '+') {
                return new Point($i, $j);
            } elseif ($this->lines[$i][$j] !== '|') {
                break;
            }
        }

        return null;
    }
}
