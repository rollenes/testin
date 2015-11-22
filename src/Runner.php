<?php

namespace TestIn;

class Runner
{
    /**
     * @param callable $test
     * @return bool
     */
    public function __invoke(Callable $test)
    {
        try {

            $test();

            return true;
        } catch(\Throwable $e) {
            return false;
        }
    }
}
