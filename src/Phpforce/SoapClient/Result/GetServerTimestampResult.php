<?php

namespace Phpforce\SoapClient\Result;

class GetServerTimestampResult
{
    public $timestamp;

    /**
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}