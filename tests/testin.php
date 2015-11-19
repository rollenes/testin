<?php

define('TESTIN_PATH', __DIR__ . '/../src/testin.php');
define('FIXTURES_PATH', __DIR__ . '/fixtures');

function runTestIn($testFile) {
    exec(PHP_BINARY . ' ' . TESTIN_PATH . ' ' . $testFile, $output);

    return $output;
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

    $output = runTestIn('');

    $expected = 'Welcome to TestIn';

    return assertEquals($output[0], $expected);
};

$displays_no_test_found = function() {

    $output = runTestIn('');

    $expected = 'No tests found :(';

    return assertEquals($output[1], $expected);
};

$displays_number_of_total_tests_found = function($path, $total) {

    $output = runTestIn($path);

    $expected = 'Total tests: ' . $total;

    return assertEquals(end($output), $expected);
};

$displays_that_test_passes = function() {

    $output = runTestIn(FIXTURES_PATH . '/passes.php');

    $expected = 'passes: OK';

    return assertEquals($output[1], $expected);
};

$displays_that_test_fails = function() {
    $output = runTestIn(FIXTURES_PATH . '/fails.php');

    $expected = 'fails: FAIL';

    return assertEquals($output[1], $expected);
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
];
