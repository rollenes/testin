<?php

namespace TestIn;

class Suite
{
    /**
     * @var callable[]
     */
    private $tests = [];

    /**
     * @var callable
     */
    private $afterTestCallback;

    public function __construct()
    {
        $this->afterTestCallback = function(){};
    }

    /**
     * @param callable $test
     * @param string $testName
     */
    public function addTest(callable $test, string $testName)
    {
        $this->tests[$testName] = $test;
    }

    /**
     * @param callable $afterTestCallback
     */
    public function setAfterTestCallback(callable $afterTestCallback)
    {
        $this->afterTestCallback = $afterTestCallback;
    }

    public function __invoke(Runner $runner)
    {
        $testNumber = 0;

        $firstFailure = null;

        foreach($this->tests as $testName => $test) {
            $testResult = $runner($test);
            $testNumber++;

            if (!$firstFailure && !$testResult->isPassed()) {
                $firstFailure = $testResult;
            }

            $this->runAfterTestCallback($testNumber, $testName, $testResult);
        }

        if ($firstFailure) {
            return Result::failed($firstFailure->getError());
        }

        return Result::passed();
    }

    /**
     * @param int $testNumber
     * @param string $testName
     * @param Result $testResult
     */
    private function runAfterTestCallback(int $testNumber, string $testName, Result $testResult)
    {
        $afterTestCallback = $this->afterTestCallback;

        $afterTestCallback($testNumber, $testName, $testResult);
    }

    public function getTestsCount() : int
    {
        return count($this->tests);
    }
}
