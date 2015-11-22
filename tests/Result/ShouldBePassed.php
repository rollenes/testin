<?php

namespace TestIn\Tests\Result;

use TestIn\Result;
use TestIn\Tests\Assert;

class ShouldBePassed
{
    public function __invoke()
    {
        $testName = 'passed-test-name';

        $ok = Result::passed($testName);

        Assert::same($ok->isPassed(), true);
        Assert::same($ok->getName(), $testName);
        Assert::same($ok->getError(), null);
    }
}