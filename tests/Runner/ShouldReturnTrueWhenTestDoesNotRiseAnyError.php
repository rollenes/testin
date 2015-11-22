<?php

namespace TestIn\Tests\Runner;

use TestIn\Runner;
use TestIn\Tests\Assert;

class ShouldReturnTrueWhenTestDoesNotRiseAnyError
{
    public function __invoke()
    {
        $testRunner = new Runner();

        $passingTest = function(){};

        Assert::same($testRunner($passingTest), true);
    }
}