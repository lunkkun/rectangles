<?php

require_once("RectangleCounter.php");

$ascii = <<<EOL
-+-++
 +-++-++|+
||  |  | |
 +--+--+-+
EOL;

$rc = new RectangleCounter($ascii);
$count = $rc->count();
echo "Total: $count";
