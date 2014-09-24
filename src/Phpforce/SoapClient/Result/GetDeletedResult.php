<?php

namespace Phpforce\SoapClient\Result;

class GetDeletedResult
{
    public $earliestDateAvailable;

    public $latestDateCovered;

    public $deletedRecords;

    /**
     * @return \DateTime
     */
    public function getEarliestDateAvailable()
    {
        return $this->earliestDateAvailable;
    }

    /**
     * @return \DateTime
     */
    public function getLatestDateCovered()
    {
        return $this->latestDateCovered;
    }

    /**
     * @return DeletedRecord[]
     */
    public function getDeletedRecords()
    {
        return $this->deletedRecords;
    }
}