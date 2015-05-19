<?php

namespace Gnoesiboe\Validator\Validator;

use Gnoesiboe\Validator\Exception\ValidationException;
use Gnoesiboe\Validator\TestCase;

/**
 * Class StringValidator
 */
final class StringValidatorTest extends TestCase
{

    public function testThrowsAValidationExceptionOnNoneStringValues()
    {
        $nonStringValues = array(
            new \StdClass(),
            array(),
            1293,
            39.93,
        );

        $stringValidator = new StringValidator();

        foreach ($nonStringValues as $nonStringValue) {
            try {
                $stringValidator->validate($nonStringValue);

                $this->fail('String validator should fail on value: ' . var_export($nonStringValue, true));
            } catch (ValidationException $exception) {
                $this->assertTrue(true);
            }
        }
    }

    public function testDoesNotThrowAValidationExceptionOnStringValue()
    {
        $stringValidator = new StringValidator();

        $stringValue = 'test';

        try {
            $stringValidator->validate($stringValue);

            $this->assertTrue(true);
        } catch (ValidationException $exception) {
            $this->fail('A validation exception was thrown');
        }
    }
}
