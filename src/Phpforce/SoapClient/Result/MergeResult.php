<?php

namespace Phpforce\SoapClient\Result;

/**
 * Merge result
 *
 */
class MergeResult
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var boolean
     */
    public $success;

    /**
     * @var array
     */
    public $errors;

    /**
     * @var array
     */
    public $mergedRecordIds;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return boolean
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function getMergedRecordIds()
    {
        return $this->mergedRecordIds;
    }
}


