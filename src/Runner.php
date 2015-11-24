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

            $result = Result::passed();
        } catch(\Throwable $e) {
            $result =  Result::failed($e);
        }

        return $result;
    }
}
