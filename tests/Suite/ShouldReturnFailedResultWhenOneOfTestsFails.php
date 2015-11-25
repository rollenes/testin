<?php

namespace TestIn\Tests\Suite;

use TestIn\Result;
use TestIn\Runner;
use TestIn\Suite;
use TestIn\Tests\Assert;

class ShouldReturnFailedResultWhenOneOfTestsFails
{
    public function __invoke()
    {
        $suite = new Suite();

        $exception = new \Exception;

        $suite->addTest(function(){}, 'passing test 1');
        $suite->addTest(function() use ($exception) {throw $exception;}, 'failing test');
        $suite->addTest(function(){}, 'passing test 2');

        $result = $suite(new Runner());

        $expected = Result::failed($exception);

        Assert::like($result, $expected);
    }
}