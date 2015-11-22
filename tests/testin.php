<?php

define('TESTIN_PATH', __DIR__ . '/../src/testin.php');
define('FIXTURES_PATH', __DIR__ . '/fixtures');

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

function runTestIn($testFile) {
    exec(PHP_BINARY . ' ' . TESTIN_PATH . ' ' . $testFile, $output, $returnedVal);

    return new TestInResult($output, $returnedVal);
}

/**
 * @param $got
 * @param $expected
 */
function assertEquals($got, $expected)
{
    return assert($got === $expected, "\nExpecting: \n$expected\nGot:\n" . $got . "\n");
}

$displays_greetings = function () {

    $result = runTestIn('');

    $expected = 'Welcome to TestIn';

    return assertEquals($result->getOutput()[0], $expected);
};

$displays_no_test_found = function() {

    $result = runTestIn('');

    $expected = 'No tests found :(';

    return assertEquals($result->getOutput()[1], $expected);
};

$displays_number_of_total_tests_found = function($path, $total) {

    $result = runTestIn($path);

    $expected = 'Total tests: ' . $total;

    $output = $result->getOutput();

    return assertEquals(end($output), $expected);
};

$displays_that_test_passes = function() {

    $result = runTestIn(FIXTURES_PATH . '/passes.php');

    $expected = 'passes: OK';

    return assertEquals($result->getOutput()[1], $expected);
};

$displays_that_test_fails = function() {

    $result = runTestIn(FIXTURES_PATH . '/fails.php');

    $expected = 'fails: FAIL';

    return assertEquals($result->getOutput()[1], $expected);
};

$returns_0_when_all_tests_passes = function() {

    $result = runTestIn(FIXTURES_PATH . '/passes.php');

    return assertEquals($result->getExitCode(), 0);
};

$returns_1_when_one_of_tests_fails = function() {

    $result = runTestIn(FIXTURES_PATH . '/fails.php');

    return assertEquals($result->getExitCode(), 1);
};

return [
    'displays_greetings' => $displays_greetings,
    'displays_no_test_found' =>  $displays_no_test_found,
    'displays_number_of_total_tests_found_1' => function() use ($displays_number_of_total_tests_found) {
        return $displays_number_of_total_tests_found(FIXTURES_PATH . '/two-tests.php', 2);
    },
    'displays_number_of_total_tests_found_2' => function() use ($displays_number_of_total_tests_found) {
        return $displays_number_of_total_tests_found(FIXTURES_PATH . '/one-test.php', 1);
    },
    'displays_that_test_passes' => $displays_that_test_passes,
    'displays_that_test_fails' => $displays_that_test_fails,
    'returns_0_when_all_tests_passes' => $returns_0_when_all_tests_passes,
    'returns_1_when_one_of_tests_fails' => $returns_1_when_one_of_tests_fails,
];
