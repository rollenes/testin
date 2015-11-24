<?php

namespace TestIn\Tests\Suite;

use TestIn\Runner;
use TestIn\Suite;
use TestIn\Summary;
use TestIn\Tests\Assert;

class ShouldRunTests
{
    public function __invoke()
    {
        $suite = new Suite();

        $passingName = 'passing test';
        $failingName = 'failing test';

        $suite->addTest(function(){}, $passingName);
        $suite->addTest(function(){throw new \Exception;}, $failingName);

        $result = $suite(new Runner());

        $expected = new Summary();

        $expected->total = 2;
        $expected->executed = 2;
        $expected->passed = [$passingName];
        $expected->failed = [$failingName];

        Assert::like($result, $expected);
    }
}