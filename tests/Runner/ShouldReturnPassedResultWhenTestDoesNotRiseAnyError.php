<?php

namespace TestIn\Tests\Runner;

use TestIn\Result;
use TestIn\Runner;
use TestIn\Tests\Assert;

class ShouldReturnPassedResultWhenTestDoesNotRiseAnyError
{
    public function __invoke()
    {
        $testRunner = new Runner(function(){});

        $testName = 'test-name';
        $passingTest = function(){};

        $expected = Result::passed($testName);

        Assert::like($testRunner($passingTest, $testName), $expected);
    }
}