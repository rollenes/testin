<?php

namespace TestIn;

class Runner
{
    /**
     * @var callable
     */
    private $afterTestCallback;

    public function __construct(Callable $afterTestCallback)
    {
        $this->afterTestCallback = $afterTestCallback;
    }

    /**
     * @param callable $test
     * @param string $testName
     * @return bool
     */
    public function __invoke(Callable $test, \string $testName)
    {
        try {

            $test();

            $result = Result::passed($testName);
        } catch(\Throwable $e) {
            $result =  Result::failed($testName, $e);
        }

        $this->dispatchAfterTestCallback($result);

        return $result;
    }

    /**
     * @param Result $testResult
     */
    private function dispatchAfterTestCallback(Result $testResult)
    {
        $passingCallback = $this->afterTestCallback;

        $passingCallback($testResult);
    }
}
