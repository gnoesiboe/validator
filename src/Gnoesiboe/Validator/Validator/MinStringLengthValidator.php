<?php

namespace Gnoesiboe\Validator\Validator;

use Gnoesiboe\Validator\Exception\ValidationException;
use Gnoesiboe\Validator\Validator;

/**
 * Class MinStringLengthValidator
 */
final class MinStringLengthValidator extends Validator
{

    /** @var string */
    const OPTION_MIN_LENGTH = 'min_length';

    /** @var string */
    const ERROR_INVALID = 'invalid';

    /**
     * @param string $value
     *
     * @throws ValidationException
     */
    public function validate($value)
    {
        $minLength = $this->getOptions()->get(self::OPTION_MIN_LENGTH);
        $this->validateMinLengthIsInteger($minLength);

        if (strlen($value) < $minLength) {
            throw $this->createValidationException(self::ERROR_INVALID, array('%min_length%' => $minLength));
        }
    }

    /**
     * @param array $options
     *
     * @throws \UnexpectedValueException
     */
    protected function validateOptions(array $options)
    {
        parent::validateOptions($options);

        if (array_key_exists(self::OPTION_MIN_LENGTH, $options) === false) {
            throw new \UnexpectedValueException('Missing required option: ' . self::OPTION_MIN_LENGTH);
        }

        if (filter_var($options[self::OPTION_MIN_LENGTH], FILTER_VALIDATE_INT) === false) {
            throw new \UnexpectedValueException('Option: ' . self::OPTION_MIN_LENGTH . ' should be of type int');
        }
    }

    /**
     * @param int $minLength
     */
    private function validateMinLengthIsInteger($minLength)
    {
        if (is_integer($minLength) === false) {
            throw new \UnexpectedValueException(self::OPTION_MIN_LENGTH . ' value should be of type integer');
        }
    }

    /**
     * @return array
     */
    protected function defineOptions()
    {
        return array(
            self::OPTION_MIN_LENGTH => null,
        );
    }

    /**
     * @return array
     */
    protected function defineErrorMessages()
    {
        return array_merge(parent::defineErrorMessages(), array(
            self::ERROR_INVALID => 'Value should have a minimum length of: %min_length%'
        ));
    }
}
