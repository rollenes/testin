<?php

namespace TestIn\Tests\Suite;

use TestIn\Runner;
use TestIn\Suite;
use TestIn\Tests\Assert;

class ShouldRunManyTests
{
    public function __invoke()
    {
        $test1 = function(){};
        $test1name = 'testName1';

        $test2 = function(){};
        $test2name = 'testName2';

        $suite = new Suite;

        $runTestsCount = 0;
        $testsNames = [];

        $afterSuiteCallback = function($testNumber, $testName) use (&$runTestsCount, &$testsNames) {
            $testsNames[] = $testName;
            $runTestsCount++;
        };

        $suite->addTest($test1, $test1name);
        $suite->addTest($test2, $test2name);

        $suite->setAfterTestCallback($afterSuiteCallback);

        $expectedTests = [$test1name, $test2name];

        $suite(new Runner());

        Assert::same($testsNames, $expectedTests);
        Assert::same($runTestsCount, 2);
    }
}