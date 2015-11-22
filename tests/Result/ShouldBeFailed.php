<?php

namespace TestIn\Tests\Result;

use TestIn\Result;
use TestIn\Tests\Assert;

class ShouldBeFailed
{
    public function __invoke()
    {
        $testName = 'failed-test-name';
        $error = new \Error();

        $ok = Result::failed($testName, $error);

        Assert::same($ok->isPassed(), false);
        Assert::same($ok->getName(), $testName);
        Assert::same($ok->getError(), $error);
    }
}