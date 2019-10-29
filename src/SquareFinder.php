<?php

namespace Lunkkun\Rectangles;

class SquareFinder extends RectangleFinder
{
    public function find(): array
    {
        return array_filter(parent::find(), function (Rectangle $rectangle) {
            return $rectangle->isSquare();
        });
    }
}
