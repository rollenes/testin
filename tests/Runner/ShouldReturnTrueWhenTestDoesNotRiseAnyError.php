<?php

namespace TestIn\Tests\Runner;

use TestIn\Runner;
use TestIn\Tests\Assert;

class ShouldReturnTrueWhenTestDoesNotRiseAnyError
{
    public function __invoke()
    {
        $passingTest = function(){};

        $testRunner = new Runner($passingTest);

        Assert::same($testRunner(), true);
    }
}