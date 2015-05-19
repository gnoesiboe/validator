<?php

namespace Gnoesiboe\Validator\Exception;

use Gnoesiboe\Validator\Exception;

/**
 * Class NonSupportedInputValueException
 */
final class NonSupportedInputKeyEncounteredException extends Exception
{

    /**
     * @var array
     */
    private $extraKeys;

    /**
     * @param string $message
     * @param array $extraKeys
     */
    public function __construct($message, array $extraKeys)
    {
        $this->extraKeys = $extraKeys;

        \Exception::__construct($message);
    }

    /**
     * @return array
     */
    public function getExtraKeys()
    {
        return $this->extraKeys;
    }
}
