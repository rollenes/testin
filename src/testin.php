<?php

echo 'Welcome to TestIn';
echo "\n";

$exitCode = 0;

if (isset($_SERVER['argv'][1])) {

    $tests = require_once $_SERVER['argv'][1];

    foreach ($tests as $name => $test) {
        echo $name . ': ';

        if ($test()) {
            echo "OK\n";
        } else {
            echo "FAIL\n";
            $exitCode = 1;
        }
    }

    echo 'Total tests: ' .count($tests);
} else {
    echo 'No tests found :(';
}

echo "\n";
exit($exitCode);