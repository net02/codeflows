<?php

function minOperations($n) {
    // 1011 requires 13 ops = (2^4)-1 - 2 (= ops required for 011)
    // 011 requires 2 moves = (2^2)-1 - 1 (= ops required for 1)
    // so we build from the bottom subtracting ops up to that point
    $ops = 0;
    $exp = 1;
    while ($n > 0) {
        if ($n & 1) {
            $ops = pow(2, $exp) - 1 - $ops;
        }
        $n >>= 1;
        $exp++;
    }
    return $ops;
}

echo "ops for 16: " . minOperations(16) . PHP_EOL;  // 31
echo "ops for 8: " . minOperations(8) . PHP_EOL;   // 15
echo "ops for 11: " . minOperations(11) . PHP_EOL;  // 13
