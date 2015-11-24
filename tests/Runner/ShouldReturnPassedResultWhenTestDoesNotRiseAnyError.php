<?php

namespace TestIn\Tests\Runner;

use TestIn\Result;
use TestIn\Runner;
use TestIn\Tests\Assert;

class ShouldReturnPassedResultWhenTestDoesNotRiseAnyError
{
    public function __invoke()
    {
        $testRunner = new Runner();

        $passingTest = function(){};

        $expected = Result::passed();

        Assert::like($testRunner($passingTest), $expected);
    }
}