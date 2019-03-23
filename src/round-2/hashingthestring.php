<?php

$tests_count = intval(trim(fgets(STDIN)));

for ($t = 0; $t < $tests_count; $t++) {
    list($n, $k) = explode(" ", trim((fgets(STDIN))));
    $n = intval($n);
    $k = intval($k);

    if ($k < $n || $k > 26 * $n) {
        fwrite(STDOUT, "-1" . PHP_EOL);
        continue;
    }
    $word = getMaxWord($n, $k);
    if (strrev($word) === $word) {
        fwrite(STDOUT, "-1" . PHP_EOL);
        continue;
    }
    fwrite(STDOUT, sprintf("%s %s", strrev($word), $word) . PHP_EOL);
}

function getMaxWord($n, $k) {
    $letters = [];
    while ($k > 0) {
        $x = min($k - $n + 1, 26);
        $k -= $x;
        $n--;

        $letters[] = chr(96 + $x);
    }
    return implode($letters);
}
