<?php

namespace Gnoesiboe\Validator\Exception;

use Gnoesiboe\Validator\Exception;

/**
 * Class ValidationExceptionSet
 */
final class ValidationExceptionSet extends Exception
{

    /**
     * @var array
     */
    private $exceptions = array();

    /**
     * @param string $key
     * @param ValidationException $exception
     *
     * @return $this
     */
    public function addException($key, ValidationException $exception)
    {
        $this->exceptions[$key] = $exception;

        return $this;
    }

    /**
     * @return array|ValidationException[]
     */
    public function getExceptions()
    {
        return $this->exceptions;
    }

    /**
     * @return bool
     */
    public function hasExceptions()
    {
        return count($this->exceptions) > 0;
    }
}
