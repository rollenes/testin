<?php

echo 'Welcome to TestIn';
echo "\n";

if (isset($_SERVER['argv'][1])) {
    $tests = require_once $_SERVER['argv'][1];

    foreach ($tests as $name => $test) {
        echo $name . ': ' . ($test() ? 'OK' : 'FAIL') . "\n";
    }

    echo 'Total tests: ' .count($tests);
} else {
    echo 'No tests found :(';
}

echo "\n";
