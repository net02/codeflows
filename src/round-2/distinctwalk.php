<?php

list($n, $qc) = explode(" ", trim((fgets(STDIN))));
$n = intval($n);
$qc = intval($qc);

$values = array_map(function($s) { return intval($s); }, explode(" ", trim((fgets(STDIN))), $n));

for ($q = 0; $q < $qc; $q++) {
    list($x, $l, $r) = explode(" ", trim((fgets(STDIN))));
    $x = intval($x);
    $l = intval($l);
    $r = intval($r);

    fwrite(STDOUT, sprintf("%d", getQueryResult(array_slice($values, $l - 1, $r - $l + 1), $x)) . PHP_EOL);
}

function getQueryResult($values, $expectedSum) {
    $initialLength = count($values);
    for ($length = $initialLength; $length > 0; $length--) {
        for ($i = 0; $i <= $initialLength - $length; $i++) {
            $v = array_slice($values, $i, $length);
            if (array_sum(array_unique($v)) <= $expectedSum) {
                return $length;
            }
        }
    }
}
