<?php

namespace TestIn\Tests\Runner;

use TestIn\Runner;
use TestIn\Tests\Assert;

class ShouldReturnFalseWhenTestDoesRiseError
{
    public function __invoke()
    {
        $testRunner = new Runner();

        $failingTest = function() {
            throw new \Error();
        };

        Assert::same($testRunner($failingTest), false);
    }
}