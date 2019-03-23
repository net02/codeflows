<?php

$tests_count = intval(trim(fgets(STDIN)));

for ($t = 0; $t < $tests_count; $t++) {
    list($k, $m) = explode(" ", trim((fgets(STDIN))));
    $m = intval($m);
    $k = intval($k);
    $senders = array_map(function($s) { return intval($s); }, explode(" ", trim((fgets(STDIN))), $m));

    $leastActive = getLeastActive($senders, $k);
    fwrite(STDOUT, sprintf("%d", $leastActive) . PHP_EOL);
}

function getLeastActive(array $senders, $n) {
    $sent = array_fill(0, $n, 0);
    $last = array_fill(0, $n, 0);

    foreach ($senders as $i => $s) {
        $sent[($s - 1)] += 1;
        $last[($s - 1)] = $i;
    }

    asort($sent);
    $keys = array_keys($sent);
    $least = array_shift($keys);
    $hasSent = $sent[$least];

    asort($last);
    foreach (array_reverse(array_keys($last)) as $intern) {
        if ($sent[$intern] === $hasSent) {
            return $intern + 1;
        }
    }

    return $n;
}
