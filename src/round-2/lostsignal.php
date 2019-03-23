<?php

$tests_count = intval(trim(fgets(STDIN)));

for ($t = 0; $t < $tests_count; $t++) {
    $offices = intval(trim(fgets(STDIN)));
    $weigths = array_map(function($s) { return intval($s); }, explode(" ", trim((fgets(STDIN)))));

    $receivers = [];
    for ($i = 1; $i < $offices; $i++) {
        list($from, $to) = explode(" ", trim((fgets(STDIN))));
        $receivers[$i] = [intval($from) - 1, intval($to)];
    }

    fwrite(STDOUT, implode(getCosts($weigths, $receivers), " ") . PHP_EOL);
}

function getCosts(array $weigths, array $receivers) {
    $costs = [
        0 => 0,
    ];

    foreach ($receivers as $office => $senders) {
        $minCost = null;
        for ($from = $senders[0]; $from < $senders[1]; $from++) {
            $cost = $costs[$from] + $weigths[$from];
            $minCost = is_null($minCost) ? $cost : min($cost, $minCost);
        }

        $costs[$office] = $minCost;
    }

    array_shift($costs);
    return $costs;
}
