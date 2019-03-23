<?php

const MOD = 1000000007;

/*
 * Complete the 'countMessages' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. STRING_ARRAY keys
 *  2. STRING message
 */
function countMessages($keys, $message) {
    // reverse keypad mapping as character => keys required
    $charToKeys = [" " => "1"];
    $key = 2;
    foreach ($keys as $chars) {
        $i = 1;
        foreach(str_split($chars) as $char) {
            $charToKeys[$char] = str_repeat($key, $i);
            $i++;
        }
        $key++;
    }
    // transmute message into keys pressed
    $keyPresses = implode(array_map(
        function($char) use ($charToKeys) {
            return $charToKeys[$char];
        },
        str_split($message)
    ));

    // compute combinations from each key sequence
    $combinationsForSequence = function($key, $qty) use ($keys) {
        if (!$key || $key === "1") {
            return 1;
        }

        $idx = intval($key) - 2;
        return strlen($keys[$idx]) === 4 ? foursomes($qty) : threesomes($qty);
    };

    $result = 1;
    $qty    = 1;
    $prev   = null;
    foreach (str_split($keyPresses) as $key) {
        if ($key !== $prev) {
            // apply the modulo here in order to avoid roundings, since:
            // (x * y * z) % k == ((x * y) % k) * z) % k
            $result = ($combinationsForSequence($prev, $qty) * $result) % MOD;
            $qty    = 1;
            $prev   = $key;
        } else {
            $qty++;
        }
    }
    $result = ($combinationsForSequence($prev, $qty) * $result) % MOD;

    return $result;
}

// Calculate combinations for 3-chars keys
function threesomes($n) {
    // it's a "tribonacci" without the starting sequence: 0 0 1 ..
    $first  = 0;
    $second = 0;
    $third  = 1;
    for ($i = 0; $i < $n; $i++) {
        // anticipate the modulo here in order to avoid roundings, since:
        // (x + y + z) % k == (x % k + y % k + z % k) % k
        $curr = $first % MOD + $second % MOD + $third % MOD;
        $first = $second;
        $second = $third;
        $third = $curr;
    }
    return $curr;
}

// Calculate combinations for 4-chars keys
function foursomes($n) {
    // it's a "tetrabonacci" without the starting sequence: 0 0 0 1 ..
    $first  = 0;
    $second = 0;
    $third  = 0;
    $fourth = 1;
    for ($i = 0; $i < $n; $i++) {
        // same as in threesomes function
        $curr = $first % MOD + $second % MOD + $third % MOD + $fourth % MOD;
        $first = $second;
        $second = $third;
        $third = $fourth;
        $fourth = $curr;
    }
    return $curr;
}

$keys_count = intval(trim(fgets(STDIN)));

$keys = array();

for ($i = 0; $i < $keys_count; $i++) {
    $keys_item = rtrim(fgets(STDIN), "\r\n");
    $keys[] = $keys_item;
}

$message = rtrim(fgets(STDIN), "\r\n");

$result = countMessages($keys, $message);

echo $result . "\n";
