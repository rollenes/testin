<?php

use TestIn\Result;
use TestIn\Runner;
use TestIn\Suite;

function printTapVersion()
{
    echo "TAP version 13\n";
}

/**
 * @param string $file
 * @return Suite
 */
function loadSuiteFromFile(string $file)
{
    $suite = new Suite();

    $tests = require_once $file;

    foreach ($tests as $testName => $test) {
        $suite->addTest($test, $testName);
    }

    return $suite;
}

function printResultCallback(int $testNumber, string $testName, Result $result) {
    echo ($result->isPassed() ? "ok" : "not ok") . ' ' . $testNumber . ' ' . $testName . "\n";
    if (!$result->isPassed()) {
        echo $result->getError() . "\n";
    }
};

$afterTestCallback = function(int $testNumber, string $testName, Result $result) {
    printResultCallback($testNumber, $testName, $result);
};

/**
 * @param int $total
 */
function printTotal(int $total)
{
    echo '1..' . $total ."\n";
}

printTapVersion();

$exitCode = 0;

if (isset($_SERVER['argv'][1])) {

    $runner = new Runner();

    $suite = loadSuiteFromFile($_SERVER['argv'][1]);

    $suite->setAfterTestCallback($afterTestCallback);

    $result = $suite($runner);

    if (!$result->isPassed()) {
        $exitCode = 1;
    }

    printTotal($suite->getTestsCount());
}

exit($exitCode);