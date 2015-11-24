<?php

namespace TestIn\Tests\Runner;

use TestIn\Result;
use TestIn\Runner;
use TestIn\Tests\Assert;

class ShouldReturnFailedResultWhenTestDoesRisesError
{
    public function __invoke()
    {
        $testRunner = new Runner(function(){});
        $error = new \Error();

        $testName = 'failing-test-name';

        $failingTest = function() use ($error) {
            throw $error;
        };

        $expected = Result::failed($testName, $error);

        Assert::like($testRunner($failingTest, $testName), $expected);
    }
}