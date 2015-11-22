<?php

namespace TestIn;

class Runner
{
    /**
     * @var Callable
     */
    private $test;

    public function __construct(Callable $test)
    {
        $this->test = $test;
    }

    public function __invoke()
    {
        try {
            $test = $this->test;

            $test();

            return true;
        } catch(\Throwable $e) {
            return false;
        }
    }
}
