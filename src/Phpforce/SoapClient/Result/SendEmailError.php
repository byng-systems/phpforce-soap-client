<?php

namespace Phpforce\SoapClient\Result;

class SendEmailError extends Error
{
    public $targetObjectId;

    public function getTargetObjectId()
    {
        return $this->targetObjectId;
    }
}