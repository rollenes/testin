<?php

require_once __DIR__ . '/vendor/autoload.php';

use TestIn\Tests\Result\ShouldBeFailed;
use TestIn\Tests\Result\ShouldBePassed;
use TestIn\Tests\Suite\ShouldDispatchAfterTestCallback;
use TestIn\Tests\Suite\ShouldHaveAsManyTestsAsAdded;
use TestIn\Tests\Suite\ShouldReturnPassedResultWhenAllOfTestsPasses;
use TestIn\Tests\Suite\ShouldRunManyTests;
use TestIn\Tests\Suite\ShouldRunOneTest;
use TestIn\Tests\Runner\ShouldReturnFailedResultWhenTestDoesRisesError;
use TestIn\Tests\Runner\ShouldReturnPassedResultWhenTestDoesNotRiseAnyError;
use TestIn\Tests\Suite\ShouldReturnFailedResultWhenOneOfTestsFails;

$tests = include __DIR__ . '/tests/testin.php';

$tests['Test Runner Should Return Passing result When Test Does Not Rise Any Error'] =
    new ShouldReturnPassedResultWhenTestDoesNotRiseAnyError();

$tests['Test Runner Should Return Failing result When Test Does Rise An Error'] =
    new ShouldReturnFailedResultWhenTestDoesRisesError();

$tests['Test Suite should run one test'] = new ShouldRunOneTest();
$tests['Test Suite should run many tests'] = new ShouldRunManyTests();
$tests['Test Suite should return failed result'] = new ShouldReturnFailedResultWhenOneOfTestsFails();
$tests['Test Suite should return passed result'] = new ShouldReturnPassedResultWhenAllOfTestsPasses();
$tests['Test suite should dispatch callback after test'] = new ShouldDispatchAfterTestCallback();
$tests['Test Suite should have as many tests as added'] = new ShouldHaveAsManyTestsAsAdded();

$tests['test result should be passed'] = new ShouldBePassed();
$tests['test result should be failed'] = new ShouldBeFailed();


return $tests;
