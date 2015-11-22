<?php

use TestIn\Runner;
use TestIn\Suite;

echo 'Welcome to TestIn';
echo "\n";

$exitCode = 0;

/**
 * @param string $file
 * @return Suite
 */
function loadSuiteFromFile(\string $file)
{
    $suite = new Suite();

    $tests = require_once $file;

    foreach ($tests as $testName => $test) {
        $suite->addTest($test, $testName);
    }

    return $suite;
}

if (isset($_SERVER['argv'][1])) {

    $runner = new Runner();

    $suite = loadSuiteFromFile($_SERVER['argv'][1]);

    $results = [];

    foreach ($suite as $name => $test) {
        if ($runner($test)) {
            $results[$name] = true;
        } else {
            $results[$name] = false;
        }
    }

    foreach ($results as $testName => $result) {
        echo $testName . ': ';

        if ($result) {
            echo "OK\n";
        } else {
            echo "FAIL\n";
            $exitCode = 1;
        }
    }

    echo 'Total tests: ' . $suite->count();
} else {
    echo 'No tests found :(';
}

echo "\n";
exit($exitCode);