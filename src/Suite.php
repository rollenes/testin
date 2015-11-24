<?php

namespace TestIn;

class Suite implements \IteratorAggregate
{
    /**
     * @var \ArrayIterator
     */
    private $tests;

    /**
     * @var callable
     */
    private $afterTestCallback;

    public function __construct()
    {
        $this->tests = new \ArrayIterator();
        $this->afterTestCallback = function(){};
    }

    public function addTest(Callable $test, \string $testName)
    {
        $this->tests[$testName] = $test;
    }

    public function getIterator()
    {
        return $this->tests;
    }

    public function count()
    {
        return $this->tests->count();
    }

    public function __invoke(Runner $runner)
    {
        $summary = new Summary();
        $summary->total = $this->count();

        foreach($this->tests as $testName => $test) {
            $testResult = $runner($test, $testName);
            $summary->executed++;

            if ($testResult->isPassed()) {
                $summary->passed[] = $testName;
            } else {
                $summary->failed[] = $testName;
            }

            $this->runAfterTestCallback($summary->executed, $testName, $testResult);
        }

        return $summary;
    }

    /**
     * @param int $testNumber
     * @param string $testName
     * @param Result $testResult
     */
    private function runAfterTestCallback(\int $testNumber, \string $testName, Result $testResult)
    {
        $afterTestCallback = $this->afterTestCallback;

        $afterTestCallback($testNumber, $testName, $testResult);
    }

    public function setAfterTestCallback(callable $afterTestCallback)
    {
        $this->afterTestCallback = $afterTestCallback;
    }
}