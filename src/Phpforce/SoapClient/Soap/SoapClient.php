<?php

namespace Phpforce\SoapClient\Soap;

use SoapClient as BaseSoapClient;
use Phpforce\SoapClient\Soap\TypeResolver\SoapTypeResolver;

/**
 * SOAP client used for the Salesforce API client
 *
 */
class SoapClient extends BaseSoapClient
{
    
    /**
     *
     * @var \Phpforce\SoapClient\Soap\TypeResolver\SoapTypeResolver 
     */
    protected $typeResolver;
    
    /**
     * SOAP types derived from WSDL
     *
     * @var array
     */
    protected $types;
    
    
    
    public function __construct(
        $wsdl,
        $options = array(),
        SoapTypeResolver $typeResolver = null
    ) {
        parent::SoapClient($wsdl, $options);
        
        if ($typeResolver !== null) {
            $typeResolver->setWsdlPath($wsdl);
        } else {
            $typeResolver = new SoapTypeResolver($wsdl);
        }
        
        $this->typeResolver = $typeResolver;
        
        $this->getSoapTypes();
    }
    
    /**
     * Retrieve SOAP types from the WSDL and parse them
     *
     * @return array    Array of types and their properties
     */
    public function getSoapTypes()
    {
        if (null === $this->types) {
            $this->types = $this->typeResolver->resolveTypesForSoapClient($this);
        }

        return $this->types;
    }
    
    /**
     * Get a SOAP type’s elements
     *
     * @param string $type Object name
     * @return array       Elements for the type
     */

    /**
     * Get SOAP elements for a complexType
     *
     * @param string $complexType Name of SOAP complexType
     *
     * @return array  Names of elements and their types
     */
    public function getSoapElements($complexType)
    {
        $types = $this->getSoapTypes();
        if (isset($types[$complexType])) {
            return $types[$complexType];
        }
    }

    /**
     * Get a SOAP type’s element
     *
     * @param string $complexType Name of SOAP complexType
     * @param string $element     Name of element belonging to SOAP complexType
     *
     * @return string
     */
    public function getSoapElementType($complexType, $element)
    {
        $elements = $this->getSoapElements($complexType);
        if ($elements && isset($elements[$element])) {
            return $elements[$element];
        }
    }
}