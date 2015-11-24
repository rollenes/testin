<?php

namespace TestIn\Tests\Runner;

use TestIn\Result;
use TestIn\Runner;
use TestIn\Tests\Assert;

class ShouldReturnFailedResultWhenTestDoesRisesError
{
    public function __invoke()
    {
        $testRunner = new Runner();
        $error = new \Exception();

        $failingTest = function() use ($error) {
            throw $error;
        };

        $expected = Result::failed($error);

        Assert::like($testRunner($failingTest), $expected);
    }
}