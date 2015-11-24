<?php

namespace TestIn;

class Result
{
    const OK = 'ok';
    const FAIL = 'fail';

    /**
     * @var string
     */
    private $status;

    /**
     * @var \Throwable
     */
    private $error;

    /**
     * @param string $status
     * @param \Throwable|null $error
     */
    private function __construct(\string $status, \Throwable $error = null)
    {
        $this->status = $status;
        $this->error = $error;
    }

    /**
     * @param string $testName
     * @return Result
     */
    public static function passed()
    {
        return new self(self::OK);
    }

    /**
     * @param string $testName
     * @param \Throwable $error
     * @return Result
     */
    public static function failed(\Throwable $error)
    {
        return new self(self::FAIL, $error);
    }

    /**
     * @return bool
     */
    public function isPassed()
    {
        return $this->status === self::OK;
    }

    /**
     * @return null|\Throwable
     */
    public function getError()
    {
        return $this->error;
    }
}
