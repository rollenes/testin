<?php

namespace TestIn\Tests\Suite;

use TestIn\Suite;
use TestIn\Tests\Assert;

class ShouldHaveOneTest
{
    public function __invoke()
    {
        $test = function(){};
        $testName = 'testName';

        $loader = new Suite;

        $loader->addTest($test, $testName);

        $expectedTests = [$testName => $test];

        Assert::same(iterator_to_array($loader), $expectedTests);
        Assert::same($loader->count(), 1);
    }
}
