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
    assert($got === $expected, "\nExpecting: \n$expected\nGot:\n" . $got . "\n");
}

$displays_greetings = function () {

    $output = runTestIn('');

    $expected = 'Welcome to TestIn';

    assertEquals($output[0], $expected);
};

$displays_no_test_found = function() {

    $output = runTestIn('');

    $expected = 'No tests found :(';

    assertEquals($output[1], $expected);
};

$displays_number_of_total_tests_found = function($path, $total) {

    $output = runTestIn($path);

    $expected = 'Total tests: ' . $total;

    assertEquals(end($output), $expected);
};

$displays_greetings();
$displays_no_test_found();
$displays_number_of_total_tests_found(FIXTURES_PATH . '/two-tests.php', 2);
$displays_number_of_total_tests_found(FIXTURES_PATH . '/one-test.php', 1);
