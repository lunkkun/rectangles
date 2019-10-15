<?php

require_once("Point.php");

class RectangleCounter
{
    public $count = 0;
    public $lines;

    function __construct(string $ascii)
    {
        $this->lines = explode(PHP_EOL, $ascii);
    }

    function count() : int
    {
        $point = null;
        while ($point = $this->findNextPlus($point)) {
            $this->findRectanglesForPoint($point);
        }

        return $this->count;
    }

    function findNextPlus(?Point $point = null) : ?Point
    {
        $iStart = $point ? $point->i : 0;
        $jStart = $point ? $point->j + 1 : 0;

        for ($i = $iStart; $i < count($this->lines); $i++) {
            for ($j = $jStart; $j < strlen($this->lines[$i]); $j++) {
                if ($this->lines[$i][$j] === '+') {
                    return new Point($i, $j);
                }
            }
            $jStart = 0;
        }

        return null;
    }

    function findRectanglesForPoint(Point $topLeft)
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
