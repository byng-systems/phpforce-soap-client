<?php
/**
 * SoapTypeResolver.php
 * Definition of class SoapTypeResolver
 * 
 * Created 01-Jul-2014 12:34:12
 *
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 * @copyright (c) 2014, Byng Systems/SkillsWeb Ltd
 */

namespace Phpforce\SoapClient\Soap\TypeResolver;

use DOMDocument;
use DOMXPath;
use SoapClient;


/**
 * SoapTypeResolver
 * 
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 */
class SoapTypeResolver
{

    /**
     * 
     */
    const TYPE_NAME_EXTRACTION_REGEX = '/^\s*struct\s+([^{]+)\s*{\s*([^}]*)\s*}/';
    
    /**
     * 
     */
    const TYPE_PROPERTIES_EXTRACTION_REGEX = 
        '/\s*(\S+)\s+([^\s;]+)\s*;$/';
    
    /**
     * XPath template for resolving supertypes
     */
    const SUPERTYPE_XPATH_TEMPLATE =
        "/wsdl:definitions/wsdl:types/xsd:schema[1]/xsd:complexType[@name='%s']/xsd:complexContent/xsd:extension/@base";
    
    /**
     * Extraction regular expression for loading the supertypes from the
     * schema definition section of the Salesforce WSDL
     */
    const SUPERTYPE_EXTRACTION_REGEX = "/^ens\:(.+)$/";
    
    /**
     *
     * @var string
     */
    protected $wsdlPath;
    
    /**
     * 
     * @var \DOMDocument|null
     */
    private $dom;
    
    /**
     *
     * @var array
     */
    private $types;
    
    /**
     *
     * @var array
     */
    private $superTypeMappings;
    
    
    /**
     * 
     * @param string $wsdlPath
     */
    public function __construct($wsdlPath)
    {
        $this->setWsdlPath($wsdlPath);
    }
    
    public function getWsdlPath()
    {
        return $this->wsdlPath;
    }

    public function setWsdlPath($wsdlPath)
    {
        $this->wsdlPath = $wsdlPath;
    }

    public function resolveTypesForSoapClient(SoapClient $soapClient)
    {
        return $this->resolveTypes($soapClient->__getTypes());
    }
    
    public function resolveTypes(array $soapTypes)
    {
        $this->dom = new DOMDocument();
        $this->dom->load($this->wsdlPath);
        
        $this->types = array();
        $this->superTypeMappings = array();
        
        foreach ($soapTypes as $soapTypeSpec) {
            if (($typeName = $this->resolveTypeName($soapTypeSpec)) === null) {
                continue;
            }
            
            if (($superTypeName = $this->resolveSuperType($typeName)) !== null) {
                $this->superTypeMappings[$typeName] = $superTypeName;
            }
            
            $this->types[$typeName] = $this->resolveTypeProperties($soapTypeSpec);
        }
        
        unset($this->dom);
        
        return $this->buildInSuperTypeProperties();
    }
    
    protected function resolveTypeName(&$typeSpec)
    {
        $matches = array();
        
        if (preg_match(self::TYPE_NAME_EXTRACTION_REGEX, $typeSpec, $matches)) {
            $typeSpec = $matches[2];
            
            return $matches[1];
        }

        return null;
    }
    
    protected function resolveTypeProperties($typeSpec)
    {
        $matches = array();
        
        if (!preg_match_all(self::TYPE_PROPERTIES_EXTRACTION_REGEX, $typeSpec, $matches)) {
            return null;
        }
        
        $properties = array();
        
        foreach ($matches[2] as $i => $match) {
            $properties[$match] = $matches[1][$i];
        }
        
        return $properties;
    }
    
    protected function resolveSuperType($typeName)
    {
        $xpath = new DOMXPath($this->dom);
        $xpath->registerNamespace("wsdl", "http://schemas.xmlsoap.org/wsdl/");
        $xpath->registerNamespace("xsd", "http://www.w3.org/2001/XMLSchema");
        
        foreach ($xpath->query(sprintf(self::SUPERTYPE_XPATH_TEMPLATE, $typeName)) as $node) {
            $matches = [];
            
            if (preg_match(self::SUPERTYPE_EXTRACTION_REGEX, $node->nodeValue, $matches)) {
                return $matches[1];
            }
        }
        
        return null;
    }
    
    protected function buildInSuperTypeProperties()
    {
        foreach ($this->superTypeMappings as $type => $superType) {
            $this->inheritSuperType($type, $superType);
        }
        
        unset($this->superTypeMappings);
        
        return $this->types;
    }
    
    protected function inheritSuperType($type, $superType)
    {
        return array_merge(
            array_merge(
                (
                    isset($this->superTypeMappings[$superType])
                    ? $this->inheritSuperType(
                        $type,
                        $this->superTypeMappings[$superType]
                    )
                    : array()
                ),
                $this->types[$superType]
            ),
            $this->types[$type]
        );
    }
    
}


