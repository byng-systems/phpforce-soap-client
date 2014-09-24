<?php

namespace Phpforce\SoapClient\Result\DescribeSObjectResult;

class Field
{
    public $autoNumber;
    public $byteLength;
    public $calculated;
    public $caseSensitive;
    public $createable;
    public $custom;
    public $defaultedOnCreate;
    public $dependentPicklist;
    public $deprecatedAndHidden;
    public $digits;
    public $filterable;
    public $groupable;
    public $htmlFormatted;
    public $idLookup;
    public $inlineHelpText;
    public $label;
    public $length;
    public $name;
    public $nameField;
    public $namePointing;
    public $nillable;
    public $picklistValues;
    public $precision;
    public $relationshipName;
    public $relationshipOrder;
    public $referenceTo = array();
    public $restrictedPicklist;
    public $scale;
    public $soapType;
    public $sortable;
    public $type;
    public $unique;
    public $updateable;
    public $writeRequiresMasterRead;

    public function isAutoNumber()
    {
        return $this->autoNumber;
    }

    public function getByteLength()
    {
        return $this->byteLength;
    }

    public function isCalculated()
    {
        return $this->calculated;
    }

    public function isCaseSensitive()
    {
        return $this->caseSensitive;
    }

    public function isCreateable()
    {
        return $this->createable;
    }

    public function isCustom()
    {
        return $this->custom;
    }

    public function isDefaultedOnCreate()
    {
        return $this->defaultedOnCreate;
    }

    public function getDependentPicklist()
    {
        return $this->dependentPicklist;
    }

    public function isDeprecatedAndHidden()
    {
        return $this->deprecatedAndHidden;
    }

    public function getDigits()
    {
        return $this->digits;
    }

    public function isFilterable()
    {
        return $this->filterable;
    }

    public function isGroupable()
    {
        return $this->groupable;
    }

    public function getHtmlFormatted()
    {
        return $this->htmlFormatted;
    }

    public function isIdLookup()
    {
        return $this->idLookup;
    }

    public function getInlineHelpText()
    {
        return $this->inlineHelpText;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNameField()
    {
        return $this->nameField;
    }

    public function isNamePointing()
    {
        return $this->namePointing;
    }

    public function isNillable()
    {
        return $this->nillable;
    }

    public function getPicklistValues()
    {
        return $this->picklistValues;
    }

    public function getPrecision()
    {
        return $this->precision;
    }

    public function getRelationshipName()
    {
        return $this->relationshipName;
    }

    public function getRelationshipOrder()
    {
        return $this->relationshipOrder;
    }

    public function getReferenceTo()
    {
        return $this->referenceTo;
    }

    public function getRestrictedPicklist()
    {
        return $this->restrictedPicklist;
    }

    public function getScale()
    {
        return $this->scale;
    }

    public function getSoapType()
    {
        return $this->soapType;
    }

    /**
     * @return boolean
     */
    public function isSortable()
    {
        return $this->sortable;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return boolean
     */
    public function isUnique()
    {
        return $this->unique;
    }

    /**
     * @return boolean
     */
    public function isUpdateable()
    {
        return $this->updateable;
    }

    /**
     * @return boolean
     */
    public function isWriteRequiresMasterRead()
    {
        return $this->writeRequiresMasterRead;
    }

    /**
     * Get whether this field references a certain object
     *
     * @param string $object     Name of the referenced object
     * @return boolean
     */
    public function references($object)
    {
        foreach ($this->referenceTo as $referencedObject) {
            return $object == $referencedObject;
        }

        return false;
    }
}