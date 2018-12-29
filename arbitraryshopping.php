<?php

/*
 * Complete the 'getMaximumOutfits' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. INTEGER_ARRAY outfits
 *  2. INTEGER money
 */
function getMaximumOutfits($outfits, $money) {
    // keep a queue of the currently selected outfits, track the longest queue
    $queue = [];
    $result = 0;
    $spent  = 0;
    $length = 0;
    for ($i = 0; $i < count($outfits); $i++) {
        // add this outfit to the queue..
        $pick = $outfits[$i];
        $queue[] = $pick;
        $spent += $pick;
        $length++;

        // then leave stuff from the start of the queue until we're ok with $$$
        while ($spent > $money) {
            $leave = array_shift($queue);
            $spent -= $leave;
            $length--;
        }
        $result = max($result, $length);
    }

    return $result;
}

$outfits_count = intval(trim(fgets(STDIN)));

$outfits = array();

for ($i = 0; $i < $outfits_count; $i++) {
    $outfits_item = intval(trim(fgets(STDIN)));
    $outfits[] = $outfits_item;
}

$money = intval(trim(fgets(STDIN)));

$result = getMaximumOutfits($outfits, $money);

echo $result;
