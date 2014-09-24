<?php

namespace Phpforce\SoapClient\Result;

class ChildRelationship
{
    public $cascadeDelete;
    public $childSObject;
    public $deprecatedAndHidden;
    public $field;
    public $relationshipName;

    public function isCascadeDelete()
    {
        return $this->cascadeDelete;
    }

    public function getChildSObject()
    {
        return $this->childSObject;
    }

    public function isDeprecatedAndHidden()
    {
        return $this->deprecatedAndHidden;
    }

    public function getField()
    {
        return $this->field;
    }

    public function getRelationshipName()
    {
        return $this->relationshipName;
    }
}