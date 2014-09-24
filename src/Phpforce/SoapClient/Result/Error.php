<?php

namespace Phpforce\SoapClient\Result;

/**
 * An error
 */
class Error
{
    public $fields;
    public $message;
    public $statusCode;

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}