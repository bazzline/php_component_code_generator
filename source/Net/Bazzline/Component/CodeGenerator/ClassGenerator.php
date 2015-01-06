<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-26 
 */

namespace Net\Bazzline\Component\CodeGenerator;

use Net\Bazzline\Component\CodeGenerator\InvalidArgumentException;
use Net\Bazzline\Component\CodeGenerator\RuntimeException;

/**
 * Class ClassGenerator
 * @package Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 */
class ClassGenerator extends SignatureGenerator
{
    /**
     * @param string $className
     * @param boolean $addToUse
     * @return $this
     */
    public function setExtends($className, $addToUse = false)
    {
        $this->addGeneratorProperty('extends', (string) $className, false);

        if ($addToUse) {
            $this->addUse($className);
        }

        return $this;
    }

    /**
     * @param string $interfaceName
     * @param boolean $addToUse
     * @return $this
     */
    public function addImplements($interfaceName, $addToUse = false)
    {
        $this->addGeneratorProperty('implements', (string) $interfaceName);

        if ($addToUse) {
            $this->addUse($interfaceName);
        }

        return $this;
    }

    /**
     * @param PropertyGenerator $property
     * @return $this
     */
    public function addProperty(PropertyGenerator $property)
    {
        $this->addGeneratorProperty('properties', $property);

        return $this;
    }

    /**
     * @param TraitGenerator $trait
     * @return $this
     */
    public function addTrait(TraitGenerator $trait)
    {
        $this->addGeneratorProperty('traits', $trait->getName());

        return $this;
    }

    /**
     * @return $this
     */
    public function markAsAbstract()
    {
        $this->addGeneratorProperty('abstract', true, false);

        return $this;
    }

    /**
     * @return $this
     */
    public function markAsFinal()
    {
        $this->addGeneratorProperty('final', true, false);

        return $this;
    }
}