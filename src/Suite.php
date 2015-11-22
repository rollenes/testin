<?php

namespace TestIn;

class Suite implements \IteratorAggregate
{
    /**
     * @var \ArrayIterator
     */
    private $tests;

    public function __construct()
    {
        $this->tests = new \ArrayIterator();
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
}