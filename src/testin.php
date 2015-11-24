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

$printResultCallback = function(\int $testNumber, \string $testName, Result $result) {
    echo ($result->isPassed() ? "ok" : "not ok") . ' ' . $testNumber . ' ' . $testName . "\n";
    if (!$result->isPassed()) {
        echo $result->getError() . "\n";
    }
};

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

    $runner = new Runner();

    $suite = loadSuiteFromFile($_SERVER['argv'][1]);

    $suite->setAfterTestCallback($printResultCallback);

    $summary = $suite($runner);

    if (!empty($summary->failed)) {
        $exitCode = 1;
    }

    printTotal($summary->total);
} else {
    printNoTestFound();
}

exit($exitCode);