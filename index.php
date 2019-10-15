<?php

class Point
{
    /** @var int */
    public $i;
    /** @var int */
    public $j;

    public function __construct(int $i = 0, int $j = 0)
    {
        $this->i = $i;
        $this->j = $j;
    }

    public function __toString()
    {
        return "({$this->i}, {$this->j})";
    }
}

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
        $current = new Point(0, -1);
        while ($plus = $this->findNextPlus($current)) {
            $this->findRectangles($plus);
            $current = $plus;
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
        $top = $topLeft;
        while ($topRight = $this->findNextCornerHorizontal($top)) {
            $right = $topRight;
            while ($bottomRight = $this->findNextCornerVertical($right)) {
                $left = $topLeft;
                while ($bottomLeft = $this->findNextCornerVertical($left)) {
                    $bottom = $bottomLeft;
                    while ($bottomRight2 = $this->findNextCornerHorizontal($bottom)) {
                        if ($bottomRight2 == $bottomRight) {
                            echo "Found one: $topLeft - $bottomRight" . PHP_EOL;
                            $this->count++;
                        }
                        $bottom = $bottomRight2;
                    }
                    $left = $bottomLeft;
                }
                $right = $bottomRight;
            }
            $top = $topRight;
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

$ascii = <<<EOL
+-++
+-++--+
|  |  |
+--+--+
EOL;

$rc = new RectangleCounter($ascii);
$count = $rc->count();
echo "Total: $count";
