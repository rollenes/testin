<?php

namespace TestIn\Tests\Result;

use TestIn\Result;
use TestIn\Tests\Assert;

class ShouldBePassed
{
    public function __invoke()
    {
        $ok = Result::passed();

        Assert::same($ok->isPassed(), true);
        Assert::same($ok->getError(), null);
    }
}