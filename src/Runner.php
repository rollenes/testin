<?php

namespace TestIn;

class Runner
{
    /**
     * @param callable $test
     * @param string $testName
     * @return bool
     */
    public function __invoke(Callable $test, \string $testName)
    {
        try {

            $test();

            return Result::passed($testName);
        } catch(\Throwable $e) {
            return Result::failed($testName, $e);
        }
    }
}
