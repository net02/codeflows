<?php

/*
 * Complete the 'exam' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts INTEGER_ARRAY v as parameter.
 */
function exam($v) {
    // convert to an array of +1 and -1
    $v = array_map(function($x) { return 2 * $x - 1; }, $v);

    $result  = 0;
    $mine    = 0;
    $against = array_sum($v);
    while (count($v) > 0) {
        if ($mine > $against) {
            break;
        }
        $x = array_shift($v);
        $mine += $x;
        $against -= $x;

        $result++;
    }

    return $result;
}

$v_count = intval(trim(fgets(STDIN)));

$v = array();

for ($i = 0; $i < $v_count; $i++) {
    $v_item = intval(trim(fgets(STDIN)));
    $v[] = $v_item;
}

$result = exam($v);
echo $result;
