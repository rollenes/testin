<?php

require_once __DIR__ . '/vendor/autoload.php';

use TestIn\Tests\Suite\ShouldHaveManyTests;
use TestIn\Tests\Suite\ShouldHaveOneTest;
use TestIn\Tests\Runner\ShouldReturnFalseWhenTestDoesRiseError;
use TestIn\Tests\Runner\ShouldReturnTrueWhenTestDoesNotRiseAnyError;

$tests = include __DIR__ . '/tests/testin.php';

$tests['Test Runner ShouldReturnTrueWhenTestDoesNotRiseAnyError'] = new ShouldReturnTrueWhenTestDoesNotRiseAnyError();
$tests['Test Runner ShouldReturnFalseWhenTestDoesRiseError'] = new ShouldReturnFalseWhenTestDoesRiseError();

$tests['Test Suite Should have one test'] = new ShouldHaveOneTest();
$tests['Test Suite Should have many tests'] = new ShouldHaveManyTests();

return $tests;