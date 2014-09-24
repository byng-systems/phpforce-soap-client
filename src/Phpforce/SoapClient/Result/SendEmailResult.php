<?php

namespace Phpforce\SoapClient\Result;

/**
 * Send email result
 */
class SendEmailResult
{
    public $errors;
    public $success;
    public $param;

    public function getErrors()
    {
        return $this->errors;
    }

    public function isSuccess()
    {
        return $this->success;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function setParam($param)
    {
        $this->param = $param;
    }
}