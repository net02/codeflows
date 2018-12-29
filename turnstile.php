<?php

/*
 * Complete the 'getTimes' function below.
 *
 * The function is expected to return an INTEGER_ARRAY.
 * The function accepts following parameters:
 *  1. INTEGER_ARRAY time
 *  2. INTEGER_ARRAY direction
 */
function getTimes($time, $direction) {
    $now    = 0;
    $lastD  = 1;
    $queue  = new TurnstileQueue();
    $result = [];
    for ($i = 0; $i < count($time); $i++) {
        $t = $time[$i];
        $d = $direction[$i];

        while ($t > $now) {
            if ($queue->length() > 0) {
                // get some people out of the queue
                $idx = $queue->next($lastD);
                if (!is_null($idx)) {
                    $result[$idx] = $now;
                    $lastD        = $direction[$idx];
                    $now++;
                }
            } elseif ($t > $now) {
                // if the queue is empty, advance time & reset direction
                $lastD = 1;
                $now   = $t;
            }
        }
        // queue current
        $queue->add($i, $d);
    }
    // empty queue
    foreach ($queue->empty($lastD) as $idx) {
        $result[$idx] = $now;
        $now++;
    }

    ksort($result);
    return $result;
}

class TurnstileQueue {
    protected $length   = 0;
    protected $queueIn  = [];
    protected $queueOut = [];

    // returns the time the queue formed
    public function length() {
        return $this->length;
    }

    // adds people to the queue
    public function add($idx, $direction) {
        if ($direction == 1) {
            $this->queueOut[] = $idx;
        } else {
            $this->queueIn[] = $idx;
        }
        $this->length++;
    }

    // returns the index of whoever leaves the queue
    public function next($direction) {
        if ($this->length == 0) {
            return null;
        }

        $this->length--;
        if ($direction == 1) {
            if (count($this->queueOut) > 0) {
                return array_shift($this->queueOut);
            } else {
                return array_shift($this->queueIn);
            }
        } else {
            if (count($this->queueIn) > 0) {
                return array_shift($this->queueIn);
            } else {
                return array_shift($this->queueOut);
            }
        }
    }

    // returns an array of indexes in the order they leave the queue, which is emptied
    public function empty($direction) {
        if ($direction == 1) {
            $idxs = array_merge($this->queueOut, $this->queueIn);
        } else {
            $idxs = array_merge($this->queueIn, $this->queueOut);
        }

        $this->queueIn  = [];
        $this->queueOut = [];
        $this->length   = 0;
        return $idxs;
    }
}

$time_count = intval(trim(fgets(STDIN)));

$time = array();

for ($i = 0; $i < $time_count; $i++) {
    $time_item = intval(trim(fgets(STDIN)));
    $time[] = $time_item;
}

$direction_count = intval(trim(fgets(STDIN)));

$direction = array();

for ($i = 0; $i < $direction_count; $i++) {
    $direction_item = intval(trim(fgets(STDIN)));
    $direction[] = $direction_item;
}

$result = getTimes($time, $direction);

echo implode("\n", $result) . "\n";
