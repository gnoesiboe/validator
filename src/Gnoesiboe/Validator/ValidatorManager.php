<?php

namespace Gnoesiboe\Validator;

use Gnoesiboe\Validator\Exception\NonSupportedInputKeyEncounteredException;
use Gnoesiboe\Validator\Exception\ValidationException;
use Gnoesiboe\Validator\Exception\ValidationExceptionSet;

/**
 * Class ValidatorManager
 */
final class ValidatorManager
{

    /**
     * @param ConstraintListSet $constraintListSet
     * @param array $input
     * @param bool $allowExtraKeys
     *
     * @throws NonSupportedInputKeyEncounteredException
     * @throws ValidationExceptionSet
     */
    public function validateListSet(ConstraintListSet $constraintListSet, array $input, $allowExtraKeys = false)
    {
        $validationExceptionSet = new ValidationExceptionSet();

        $constraintKeys = $constraintListSet->getKeys();

        if ($allowExtraKeys === false) {
            $this->validateNonSupportedInputKeysAreSupplied($constraintKeys, $input);
        }

        foreach ($constraintKeys as $key) {
            $constraintList = $constraintListSet->get($key);

            $value = array_key_exists($key, $input) === true ? $input[$key] : null;

            try {
                $this->validateList($constraintList, $value);
            } catch (ValidationException $validationException) {
                $validationExceptionSet->addException($key, $validationException);
            }
        }

        if ($validationExceptionSet->hasExceptions() === true) {
            throw $validationExceptionSet;
        }
    }

    /**
     * @param array $constraintKeys
     * @param array $input
     *
     * @throws NonSupportedInputKeyEncounteredException
     */
    private function validateNonSupportedInputKeysAreSupplied(array $constraintKeys, array $input)
    {
        $inputKeys = array_keys($input);
        $extraKeys = array_diff($inputKeys, $constraintKeys);

        if (count($extraKeys) > 0) {
            throw new NonSupportedInputKeyEncounteredException('Encountered non supported input keys: ' . implode(', ', $extraKeys), $extraKeys);
        }
    }

    /**
     * @param ConstraintList $constraintList
     * @param mixed $value
     *
     * @throws ValidationException
     */
    public function validateList(ConstraintList $constraintList, $value)
    {
        foreach ($constraintList as $validator) {
            /** @var Validator $validator */

            $validator->validate($value);
        }
    }
}
