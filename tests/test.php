<?php

$displays_greetings = function () {

    $pathToFramework = __DIR__ . '/../src/testin.php';

    exec(PHP_BINARY . ' ' . $pathToFramework, $output);

    $expected = 'Welcome to TestIn';

    assert($output[0] === $expected, "\nExpecting: \n$expected\nGot:\n" . $output[0] . "\n");
};

$displays_no_test_found = function() {
    $pathToFramework = __DIR__ . '/../src/testin.php';

    exec(PHP_BINARY . ' ' . $pathToFramework, $output);

    $expected = 'No tests found :(';

    assert($output[1] === $expected, "\nExpecting: \n$expected\nGot:\n" . $output[1] . "\n");
};

$displays_greetings();
$displays_no_test_found();
