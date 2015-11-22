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
        $results[] = $runner($test, $name);
    }


    foreach ($results as $testNumber => $result) {

        if (!$result->isPassed()) {
            $exitCode = 1;
        }

        echo ($result->isPassed() ? "ok" : "not ok") . ' ' . ($testNumber + 1). ' ' . $result->getName() . "\n";
    }

    echo '1..' . $suite->count();
} else {
    echo 'No tests found :(';
}

echo "\n";
exit($exitCode);