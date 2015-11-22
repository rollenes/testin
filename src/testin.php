<?php

use TestIn\Result;
use TestIn\Runner;
use TestIn\Suite;

function printGreetings()
{
    echo "Welcome to TestIn by @rollenes\n";
}

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

/**
 * @param Result $result
 * @param int $testNumber
 */
function printTestResult(Result $result, \int $testNumber)
{
    echo ($result->isPassed() ? "ok" : "not ok") . ' ' . ($testNumber + 1) . ' ' . $result->getName() . "\n";
}

/**
 * @param Suite $suite
 */
function printTotal(Suite $suite)
{
    echo '1..' . $suite->count() ."\n";
}

function printNoTestFound()
{
    echo "No tests found :(\n";
}

printGreetings();

$exitCode = 0;

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

        printTestResult($result, $testNumber);
    }

    printTotal($suite);
} else {
    printNoTestFound();
}

exit($exitCode);