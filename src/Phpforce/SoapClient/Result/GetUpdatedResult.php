<?php

namespace Phpforce\SoapClient\Result;

class GetUpdatedResult
{
    public $ids = array();

    public $latestDateCovered;

    /**
     * @return array
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @return \DateTime
     */
    public function getLatestDateCovered()
    {
        return $this->latestDateCovered;
    }
}