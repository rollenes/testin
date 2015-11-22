<?php

namespace TestIn;

class Result
{
    const OK = 'ok';
    const FAIL = 'fail';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \Throwable
     */
    private $error;

    /**
     * @param string $testName
     * @param string $status
     * @param \Throwable|null $error
     */
    private function __construct(\string $testName, \string $status, \Throwable $error = null)
    {
        $this->name = $testName;
        $this->status = $status;
        $this->error = $error;
    }

    /**
     * @param string $testName
     * @return Result
     */
    public static function passed(\string $testName)
    {
        return new self($testName, self::OK);
    }

    /**
     * @param string $testName
     * @param \Throwable $error
     * @return Result
     */
    public static function failed(\string $testName, \Throwable $error)
    {
        return new self($testName, self::FAIL, $error);
    }

    /**
     * @return bool
     */
    public function isPassed()
    {
        return $this->status === self::OK;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return null|\Throwable
     */
    public function getError()
    {
        return $this->error;
    }
}
