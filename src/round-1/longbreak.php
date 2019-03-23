<?php

/*
 * Complete the 'findBreakDuration' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. INTEGER n
 *  2. INTEGER k
 *  3. INTEGER t
 *  4. INTEGER_ARRAY start
 *  5. INTEGER_ARRAY finish
 */
function findBreakDuration($n, $k, $t, $start, $finish) {
    // get an array of $n+1 ordered breaks duration, with 0 representing two consecutive
    // presentations.
    $breaks = [];
    $time = 0;
    for ($i = 0; $i < $n; $i++) {
        $breaks[] = $start[$i] - $time;
        $time = $finish[$i];
    }
    $breaks[] = $t - $time;

    // find longest break possible by summing $k+1 adjacent breaks
    $q = $k + 1;
    $slice = array_slice($breaks, 0, $q);
    $sum = array_sum($slice);
    $longest = $sum;
    for ($i = 0; $i < count($breaks) - $q; $i++) {
        $sum = $sum - $breaks[$i] + $breaks[($i + $q)];
        $longest = max($longest, $sum);
    }

    return $longest;
}

$n = intval(trim(fgets(STDIN)));

$k = intval(trim(fgets(STDIN)));

$t = intval(trim(fgets(STDIN)));

$start_count = intval(trim(fgets(STDIN)));

$start = array();

for ($i = 0; $i < $start_count; $i++) {
    $start_item = intval(trim(fgets(STDIN)));
    $start[] = $start_item;
}

$finish_count = intval(trim(fgets(STDIN)));

$finish = array();

for ($i = 0; $i < $finish_count; $i++) {
    $finish_item = intval(trim(fgets(STDIN)));
    $finish[] = $finish_item;
}

$result = findBreakDuration($n, $k, $t, $start, $finish);
echo $result . PHP_EOL;
