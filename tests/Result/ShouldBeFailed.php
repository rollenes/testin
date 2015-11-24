<?php

namespace TestIn\Tests\Result;

use TestIn\Result;
use TestIn\Tests\Assert;

class ShouldBeFailed
{
    public function __invoke()
    {
        $error = new \Error();

        $ok = Result::failed($error);

        Assert::same($ok->isPassed(), false);
        Assert::same($ok->getError(), $error);
    }
}