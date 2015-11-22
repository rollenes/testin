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

    $testNumber = 0;
    foreach ($results as $testName => $result) {

        if (!$result) {
            $exitCode = 1;
        }

        echo ($result ? "ok" : "not ok") . ' ' . ++$testNumber . ' ' . $testName . "\n";
    }

    echo 'Total tests: ' . $suite->count();
} else {
    echo 'No tests found :(';
}

echo "\n";
exit($exitCode);