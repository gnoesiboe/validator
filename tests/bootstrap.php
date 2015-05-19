<?php

use Gnoesiboe\Validator\ConstraintList;
use Gnoesiboe\Validator\ConstraintListSet;
use Gnoesiboe\Validator\Validator\MinStringLengthValidator;
use Gnoesiboe\Validator\Validator\StringValidator;

require_ONCE __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Gnoesiboe/Validator/TestCase.php';

$validatorManager = new \Gnoesiboe\Validator\ValidatorManager();

$listSet = new ConstraintListSet(array(
    'water' => new ConstraintList(array(
        new StringValidator(),
        new MinStringLengthValidator(array(MinStringLengthValidator::OPTION_MIN_LENGTH => 3))
    ))
));

$input = array(
    'water' => '3923'
);

$validatorManager->validateListSet($listSet, $input);

