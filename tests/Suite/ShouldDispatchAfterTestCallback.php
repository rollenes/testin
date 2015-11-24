<?php

namespace TestIn\Tests\Suite;

use TestIn\Result;
use TestIn\Runner;
use TestIn\Suite;
use TestIn\Tests\Assert;

class ShouldDispatchAfterTestCallback
{
    public function __invoke()
    {
        $passingTest = function() {};
        $passingTestName = 'passing test';

        $afterTestCallback = function ($testNumber, $testName, $testResult) use (&$spy) {
            $spy = (object)[
                'testNumber' => $testNumber,
                'testName' => $testName,
                'testResult' => $testResult
            ];
        };

        $runner = new Runner();

        $suite = new Suite();

        $suite->setAfterTestCallback($afterTestCallback);

        $suite->addTest($passingTest, $passingTestName);

        $suite($runner);

        $expected = new \stdClass();
        $expected->testNumber = 1;
        $expected->testName = $passingTestName;
        $expected->testResult = Result::passed($passingTestName);

        Assert::like($spy, $expected);
    }
}