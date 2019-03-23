<?php

$tests_count = intval(trim(fgets(STDIN)));

for ($t = 0; $t < $tests_count; $t++) {
    $offices = intval(trim(fgets(STDIN)));
    $weights = array_map(function($s) { return intval($s); }, explode(" ", trim((fgets(STDIN)))));

    $configs = [];
    for ($i = 1; $i < $offices; $i++) {
        list($from, $to) = explode(" ", trim((fgets(STDIN))));
        $configs[$i] = [intval($from) - 1, intval($to) - intval($from) + 1];
    }

    fwrite(STDOUT, implode(getCosts($weights, $configs), " ") . PHP_EOL);
}

function getCosts(array $weights, array $configs) {
    $costs = [
        0 => $weights[0],
    ];
    $results = [];

    foreach ($configs as $office => $config) {
        $cost = min(array_slice($costs, $config[0], $config[1]));
        $costs[$office] = $cost + ($weights[$office] ?? 0);
        $results[] = $cost;
    }

    return $results;
}
