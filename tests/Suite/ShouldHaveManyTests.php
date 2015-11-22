<?php

namespace TestIn\Tests\Suite;

use TestIn\Suite;
use TestIn\Tests\Assert;

class ShouldHaveManyTests
{
    public function __invoke()
    {
        $test1 = function(){};
        $test1name = 'testName1';

        $test2 = function(){};
        $test2name = 'testName2';

        $loader = new Suite;

        $loader->addTest($test1, $test1name);
        $loader->addTest($test2, $test2name);

        $expectedTests = [$test1name => $test1, $test2name => $test2];

        Assert::same(iterator_to_array($loader), $expectedTests);
        Assert::same($loader->count(), 2);
    }
}