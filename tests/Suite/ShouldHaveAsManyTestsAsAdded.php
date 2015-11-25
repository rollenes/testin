<?php

namespace TestIn\Tests\Suite;

use TestIn\Suite;
use TestIn\Tests\Assert;

class ShouldHaveAsManyTestsAsAdded
{
    public function __invoke()
    {
        $test = function() {};

        $suite = new Suite();

        Assert::same($suite->getTestsCount(), 0);

        $suite = new Suite();
        $suite->addTest($test, 'test1');

        Assert::same($suite->getTestsCount(), 1);

        $suite = new Suite();
        $suite->addTest($test, 'test1');
        $suite->addTest($test, 'test2');

        Assert::same($suite->getTestsCount(), 2);

    }
}