<?php

namespace TestIn\Tests\TestRunner;

use TestIn\Runner;
use TestIn\Tests\Assert;

class ShouldReturnFalseWhenTestDoesRiseError
{
    public function __invoke()
    {
        $failingTest = function() {
            throw new \Error();
        };

        $testRunner = new Runner($failingTest);

        Assert::same($testRunner(), false);
    }
}