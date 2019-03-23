<?php

$n = intval(trim(fgets(STDIN)));
$values = array_map(function($s) { return intval($s); }, explode(" ", trim((fgets(STDIN))), $n));

fwrite(STDOUT, sprintf("%d", getInversions($values)) . PHP_EOL);

function getInversions($values) {
    $inversions = 0;

    $tot = count($values);
    for ($i = 0; $i < $tot; $i++) {
        $val = $values[$i];
        if ($i > 0) {
            $prev = $values[($i - 1)];
            if ($val > $prev) {
                continue;
            }
        }

        $next = $values[($i + 1)] ?? 501;
        $max = max(array_slice($values, $i, $tot - $i));
        if ($val != $max && $val > $next) {
            $inversions += pow(2, $i);
        }
    }
    return $inversions;
}
