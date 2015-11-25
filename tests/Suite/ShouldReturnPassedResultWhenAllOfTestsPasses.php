<?php

namespace TestIn\Tests\Suite;

use TestIn\Result;
use TestIn\Runner;
use TestIn\Suite;
use TestIn\Tests\Assert;

class ShouldReturnPassedResultWhenAllOfTestsPasses
{
    public function __invoke()
    {
        $suite = new Suite();

        $exception = new \Exception;

        $suite->addTest(function(){}, 'passing test 1');
        $suite->addTest(function(){}, 'passing test 2');

        $result = $suite(new Runner());

        $expected = Result::passed();

        Assert::like($result, $expected);
    }
}