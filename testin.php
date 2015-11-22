<?php

require_once __DIR__ . '/vendor/autoload.php';

use TestIn\Tests\Result\ShouldBeFailed;
use TestIn\Tests\Result\ShouldBePassed;
use TestIn\Tests\Suite\ShouldHaveManyTests;
use TestIn\Tests\Suite\ShouldHaveOneTest;
use TestIn\Tests\Runner\ShouldReturnFailedResultWhenTestDoesRisesError;
use TestIn\Tests\Runner\ShouldReturnPassedResultWhenTestDoesNotRiseAnyError;

$tests = include __DIR__ . '/tests/testin.php';

$tests['Test Runner Should Return Passing result When Test Does Not Rise Any Error'] =
    new ShouldReturnPassedResultWhenTestDoesNotRiseAnyError();

$tests['Test Runner Should Return Failing result When Test Does Rise An Error'] =
    new ShouldReturnFailedResultWhenTestDoesRisesError();

$tests['Test Suite Should have one test'] = new ShouldHaveOneTest();
$tests['Test Suite Should have many tests'] = new ShouldHaveManyTests();

$tests['test result should be passed'] = new ShouldBePassed();
$tests['test result should be failed'] = new ShouldBeFailed();

return $tests;