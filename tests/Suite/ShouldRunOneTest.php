<?php

namespace TestIn\Tests\Suite;

use TestIn\Runner;
use TestIn\Suite;
use TestIn\Tests\Assert;

class ShouldRunOneTest
{
    public function __invoke()
    {
        $test = function(){};
        $testName = 'testName';

        $suite = new Suite;

        $runTestsCount = 0;
        $testsNames = [];

        $afterSuiteCallback = function($testNumber, $testName) use (&$runTestsCount, &$testsNames) {
            $testsNames[] = $testName;
            $runTestsCount++;
        };

        $suite->setAfterTestCallback($afterSuiteCallback);
        $suite->addTest($test, $testName);

        $suite(new Runner());

        $expectedTests = [$testName];

        Assert::same($testsNames, $expectedTests);
        Assert::same($runTestsCount, 1);
    }
}
