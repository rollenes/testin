<?php

namespace TestIn\Tests\Runner;

use TestIn\Runner;
use TestIn\Tests\Assert;

class ShouldDispatchAfterTestCallback
{
    public function __invoke()
    {
        $passingTest = function() {};
        $passingTestName = 'passing test';

        $afterTestCallback = function ($testResult) use (&$spy) {
            $spy = $testResult;
        };

        $runner = new Runner($afterTestCallback);

        $testResult = $runner($passingTest, $passingTestName);

        Assert::same($spy, $testResult);
    }
}