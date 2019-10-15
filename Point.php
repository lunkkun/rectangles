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
