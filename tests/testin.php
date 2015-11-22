<?php

use TestIn\Tests\Assert;

define('TESTIN_CMD', realpath(__DIR__ . '/../bin/testin'));
define('FIXTURES_PATH', realpath(__DIR__ . '/fixtures'));

class TestInResult
{
    /**
     * @var string[]
     */
    private $output;

    /**
     * @var int
     */
    private $exitCode;

    public function __construct(array $output, int $exitCode)
    {
        $this->output = $output;
        $this->exitCode = $exitCode;
    }

    /**
     * @return string[]
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @return int
     */
    public function getExitCode()
    {
        return $this->exitCode;
    }
}

/**
 * @param string $testFile
 * @return TestInResult
 */
function runTestIn(string $testFile) {
    exec(PHP_BINARY . ' ' . TESTIN_CMD . ' ' . $testFile, $output, $returnedVal);

    return new TestInResult($output, $returnedVal);
}

$displays_greetings = function () {

    $result = runTestIn('');

    $expected = 'Welcome to TestIn';

    Assert::same($result->getOutput()[0], $expected);
};

$displays_no_test_found = function() {

    $result = runTestIn('');

    $expected = 'No tests found :(';

    Assert::same($result->getOutput()[1], $expected);
};

$displays_number_of_total_tests_found = function($path, $total) {

    $result = runTestIn($path);

    $expected = '1..' . $total;

    $output = $result->getOutput();

    Assert::same(end($output), $expected);
};

$displays_that_test_passes = function() {

    $result = runTestIn(FIXTURES_PATH . '/passes.php');

    $expected = 'ok 1 passes';

    Assert::same($result->getOutput()[1], $expected);
};

$displays_that_test_fails = function() {

    $result = runTestIn(FIXTURES_PATH . '/fails.php');

    $expected = 'not ok 1 fails';

    Assert::same($result->getOutput()[1], $expected);
};

$displays_tests_in_tap_format = function() {

    $result = runTestIn(FIXTURES_PATH . '/two-tests.php');

    $expectedFirst = 'ok 1 test-first';
    $expectedSecond = 'ok 2 test-second';

    Assert::same($result->getOutput()[1], $expectedFirst);
    Assert::same($result->getOutput()[2], $expectedSecond);
};

$returns_0_when_all_tests_passes = function() {

    $result = runTestIn(FIXTURES_PATH . '/passes.php');

    Assert::same($result->getExitCode(), 0);
};

$returns_1_when_one_of_tests_fails = function() {

    $result = runTestIn(FIXTURES_PATH . '/fails.php');

    Assert::same($result->getExitCode(), 1);
};

return [
    'displays_greetings' => $displays_greetings,
    'displays_no_test_found' =>  $displays_no_test_found,
    'displays_number_of_total_tests_found_1' => function() use ($displays_number_of_total_tests_found) {
        $displays_number_of_total_tests_found(FIXTURES_PATH . '/two-tests.php', 2);
    },
    'displays_number_of_total_tests_found_2' => function() use ($displays_number_of_total_tests_found) {
        $displays_number_of_total_tests_found(FIXTURES_PATH . '/one-test.php', 1);
    },
    'displays_that_test_passes' => $displays_that_test_passes,
    'displays_that_test_fails' => $displays_that_test_fails,
    'displays_tests_in_tap_format' => $displays_tests_in_tap_format,
    'returns_0_when_all_tests_passes' => $returns_0_when_all_tests_passes,
    'returns_1_when_one_of_tests_fails' => $returns_1_when_one_of_tests_fails,
];
