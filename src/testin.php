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
    if (!$result->isPassed()) {
        echo $result->getError() . "\n";
    }
}

/**
 * @param int $total
 */
function printTotal(\int $total)
{
    echo '1..' . $total ."\n";
}

function printNoTestFound()
{
    echo "No tests found :(\n";
}

printGreetings();

$exitCode = 0;

if (isset($_SERVER['argv'][1])) {

    $runner = new Runner(function(){});

    $suite = loadSuiteFromFile($_SERVER['argv'][1]);

    $results = [];

    $summary = $suite($runner);

    foreach ($suite as $name => $test) {
        $results[] = $runner($test, $name);
    }

    foreach ($results as $testNumber => $result) {
        printTestResult($result, $testNumber);
    }

    if (!empty($summary->failed)) {
        $exitCode = 1;
    }

    printTotal($summary->total);
} else {
    printNoTestFound();
}

exit($exitCode);