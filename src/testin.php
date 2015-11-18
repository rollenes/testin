<?php

echo 'Welcome to TestIn';
echo "\n";

if (isset($_SERVER['argv'][1])) {
    $tests = require_once $_SERVER['argv'][1];
    echo 'Total tests: ' .count($tests);
} else {
    echo 'No tests found :(';
}

