<?php

require_once("RectangleCounter.php");

$ascii = <<<EOL
-+-++
 +-+++-+|+
||  |  | |
 +--+--+-+
EOL;

$rc = new RectangleCounter($ascii);
$count = $rc->count();

foreach ($rc->rectangles as $rectangle) {
    echo $rectangle . PHP_EOL;
}

echo "Total: $count";
